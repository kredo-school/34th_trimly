<?php

namespace App\Http\Controllers\PetOwner\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;

class ReservationController extends Controller
{
    public function index()
    {
        // ダミー。あとで DB に置き換える
        $upcomingAppointments = [];
        $historyAppointments = [];

        return view('mypage.reservation', compact('upcomingAppointments', 'historyAppointments'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        // 自分の予約かチェック
        if ($appointment->pet->pet_owner_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $appointment->update($request->only([
            'appointment_date',
            'appointment_time_start',
            'appointment_time_end',
            'service_item_id'
        ]));

        return back()->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        if ($appointment->pet->pet_owner_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $appointment->delete();

        return back()->with('success', 'Appointment cancelled.');
    }

    public function rebook(Request $request, Appointment $appointment)
    {
        // 本人確認
        if ($appointment->pet->pet_owner_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // バリデーション（例: 日付・時間必須）
        $request->validate([
            'appointment_date' => 'required|date',
            'appointment_time_start' => 'required',
        ]);

        // 元の予約をコピー
        $newAppointment = $appointment->replicate();

        // 新しい確認番号（ユニーク必須）
        $newAppointment->confirmation_number = uniqid('AP-');

        // 日時を上書き
        $newAppointment->appointment_date = $request->appointment_date;
        $newAppointment->appointment_time_start = $request->appointment_time_start;
        $newAppointment->appointment_time_end = $request->appointment_time_end ?? null;

        // ステータスを Upcoming にリセット
        $newAppointment->status = 1;

        // 保存
        $newAppointment->save();

        return redirect()->route('mypage.reservation.index')
            ->with('success', 'Appointment rebooked successfully.');
    }
}
