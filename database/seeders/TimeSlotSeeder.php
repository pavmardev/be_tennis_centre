<?php

namespace Database\Seeders;

use App\Models\TimeSlot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeSlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 9; $i <= 20; $i++) {
            TimeSlot::insert(
                [
                    'time_slot' => $i . ':00'
                ]);
        }
    }
}
