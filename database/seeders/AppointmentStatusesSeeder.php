<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AppointmentStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['status_name' => 1, 'display_name' => 'confirmed'],
            ['status_name' => 2, 'display_name' => 'cancelled'],
            ['status_name' => 3, 'display_name' => 'completed'],
            ['status_name' => 4, 'display_name' => 'pending'],
        ];

        foreach ($statuses as $status) {
            DB::table('appointment_statuses')->updateOrInsert(
                ['status_name' => $status['status_name']],
                [
                    'display_name' => $status['display_name'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            );
        }
    }
}
