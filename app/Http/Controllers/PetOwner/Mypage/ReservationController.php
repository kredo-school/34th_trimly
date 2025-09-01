<?php

namespace App\Http\Controllers\PetOwner\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\Salon;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $upcomingAppointments = Appointment::with(['pet', 'salon.openDays', 'serviceItem', 'appointmentStatus'])
            ->whereHas('pet', fn($q) => $q->where('pet_owner_id', $userId))
            ->whereDate('appointment_date', '>=', now())
            ->where('status', 1)
            ->orderBy('appointment_date', 'asc')
            ->get();

        $historyAppointments = Appointment::withTrashed()
            ->with(['pet', 'salon.openDays', 'serviceItem', 'appointmentStatus'])
            ->whereHas('pet', fn($q) => $q->where('pet_owner_id', $userId))
            ->where(fn($q) => $q->where('status', '!=', 1)
                ->orWhereDate('appointment_date', '<', now()))
            ->orderBy('appointment_date', 'desc')
            ->get();

        // 🔹 各予約ごとに availableSlots を生成
        $availableSlots = [];
        foreach ($upcomingAppointments->merge($historyAppointments) as $appointment) {
            if ($appointment->salon) {
                $availableSlots[$appointment->id] = $this->getAvailableSlots(
                    $appointment->salon->id,
                    Carbon::parse($appointment->appointment_date)->toDateString()
                );
            }
        }

        return view('mypage.reservation', compact(
            'upcomingAppointments',
            'historyAppointments',
            'availableSlots'
        ));
    }



    public function update(Request $request, Appointment $appointment)
    {
        if ($appointment->pet->pet_owner_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'appointment_date' => 'required|date',
            'appointment_time_start' => 'required|date_format:H:i',
            'service_item_id' => 'required|exists:service_items,id',
        ]);

        $appointmentDateTime = \Carbon\Carbon::parse($request->appointment_date . ' ' . $request->appointment_time_start);
        $service = $appointment->salon->serviceItems()->find($request->service_item_id);
        $appointmentEndTime = $appointmentDateTime->copy()->addMinutes($service->duration);

        $appointment->update([
            'appointment_date' => $appointmentDateTime,
            'appointment_time_start' => $appointmentDateTime->toTimeString(),
            'appointment_time_end' => $appointmentEndTime->toTimeString(),
            'service_item_id' => $request->service_item_id,
        ]);

        return back()->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        if ($appointment->pet->pet_owner_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // ① ステータスをキャンセル (2 = cancelled)
        $appointment->status = 2;
        $appointment->save();

        // ② 論理削除 (deleted_at に日時が入る)
        $appointment->delete();

        return back()->with('success', 'Appointment cancelled.');
    }


    private function getAvailableSlots($salonId, $date)
    {
        $salon = Salon::with('openDays')->findOrFail($salonId);

        // 営業曜日チェック
        $dayName = Carbon::parse($date)->format('l');
        if (!$salon->openDays->pluck('day_of_week')->contains($dayName)) {
            return []; // 定休日は空配列
        }

        $slots = [];
        $open = Carbon::parse($salon->open_time);
        $close = Carbon::parse($salon->close_time);

        for ($time = $open->copy(); $time < $close; $time->addMinutes(30)) {
            $slots[] = $time->format('H:i'); // 配列に追加
        }

        return $slots;
    }

    public function rebook(Request $request, Appointment $appointment)
    {
        if ($appointment->pet->pet_owner_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'appointment_date' => 'required|date',
            'appointment_time_start' => 'required|date_format:H:i',
        ]);

        $salon = $appointment->salon;
        $service = $appointment->serviceItem;

        if (!$salon || !$service) {
            return back()->with('error', 'Salon or service not found.');
        }

        // 開始・終了時間を Carbon に変換
        $appointmentDateTime = \Carbon\Carbon::parse($request->appointment_date . ' ' . $request->appointment_time_start);
        $appointmentEndTime = $appointmentDateTime->copy()->addMinutes($service->duration);

        // 営業曜日チェックを追加
        $dayName = Carbon::parse($request->appointment_date)->format('l');
        if (!$salon->openDays->pluck('day_of_week')->contains($dayName)) {
            return back()->with('error', 'The salon is closed on the selected day.');
        }
        // 営業時間チェック
        $openTime  = Carbon::parse($request->appointment_date . ' ' . $salon->open_time);
        $closeTime = Carbon::parse($request->appointment_date . ' ' . $salon->close_time);

        if ($appointmentDateTime->lt($openTime) || $appointmentEndTime->gt($closeTime)) {
            return back()->with('error', 'The selected time is outside salon business hours.');
        }

        // まず仮の予約番号を入れて保存
        $newAppointment = new Appointment();
        $newAppointment->confirmation_number = 'TEMP'; // 仮の値
        $newAppointment->salon_code = $appointment->salon_code;
        $newAppointment->pet_id = $appointment->pet_id;
        $newAppointment->service_item_id = $appointment->service_item_id;
        $newAppointment->appointment_date = $appointmentDateTime;
        $newAppointment->appointment_time_start = $appointmentDateTime->toTimeString();
        $newAppointment->appointment_time_end = $appointmentEndTime->toTimeString();
        $newAppointment->status = 1; // confirmed
        $newAppointment->save();

        // id が確定したので予約番号を発番して更新
        $newAppointment->confirmation_number = 'TRM-' . date('Y') . '-' . str_pad($newAppointment->id, 6, '0', STR_PAD_LEFT);
        $newAppointment->save();

        return redirect()->route('mypage.reservation.index')
            ->with('success', 'Appointment rebooked successfully.');
    }
}
