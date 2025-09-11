<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TestServiceItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('service_items')->insert([
            'salon_code' => 'TEST_SALON_001',
            'servicename' => 'test Full Grooming Package',
            'category' => 'grooming',
            'duration' => 60,
            'price' => 50.00,
            'description' => 'Full grooming package for your pet',
            'servicefeatures' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
