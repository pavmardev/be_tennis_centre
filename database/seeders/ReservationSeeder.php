<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reservation::insert([
            [
                'user_id' => 1,
                'court_id' => 1,
                'time_slot_id' => 1,
                'reservation_date' => '2019-01-11',
            ],
            [
                'user_id' => 1,
                'court_id' => 3,
                'time_slot_id' => 2,
                'reservation_date' => '2019-08-22',
            ],
            [
                'user_id' => 3,
                'court_id' => 2,
                'time_slot_id' => 2,
                'reservation_date' => '2019-11-18',
            ],
            [
                'user_id' => 2,
                'court_id' => 3,
                'time_slot_id' => 3,
                'reservation_date' => '2019-04-06',
            ]]
        );
    }
}
