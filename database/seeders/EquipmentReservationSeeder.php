<?php

namespace Database\Seeders;

use App\Models\EquipmentReservation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EquipmentReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EquipmentReservation::insert([
            [
                'equipment_id' => 1,
                'reservation_id' => 1,
            ],
            [
                'equipment_id' => 2,
                'reservation_id' => 1,
            ],
            [
                'equipment_id' => 3,
                'reservation_id' => 1,
            ],
            [
                'equipment_id' => 2,
                'reservation_id' => 2,
            ],
            [
                'equipment_id' => 3,
                'reservation_id' => 2,
            ],
            [
                'equipment_id' => 3,
                'reservation_id' => 3,
            ]]
        );
    }
}
