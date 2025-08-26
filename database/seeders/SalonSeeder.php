<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Salon;

class SalonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Salon::create([
            'salon_code' => 'TEST_SALON_001',
            'salonname' => 'TEST SALON',
            'firstname' => 'TARO',
            'lastname' => 'YAMADA',
            'email_address' => 'test@example.com',
            'phone' => '09012345678', 
            'state' => 'Tokyo',
            'password' => Hash::make('password'),
            'open_time' => '09:00:00',
            'close_time' => '18:00:00',
        ]);

        $this->command->info('Salon record created successfully using Eloquent.');
    }
    
}
