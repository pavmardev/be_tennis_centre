<?php

namespace Database\Seeders;

use App\Models\Court;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Court::insert([
            [
                'name' => 'Court Centrale',
                'surface' => 'clay',
                'description' => 'Our flagship clay court with premium Har-Tru surface and stadium seating for up to 80 spectators.',
                'price' => 28
            ],
            [
                'name' => 'Court Roland',
                'surface' => 'clay',
                'description' => 'Classic red clay with excellent grip and natural bounce, perfect for baseline play.',
                'price' => 24
            ],
            [
                'name' => 'Court Wimbledon',
                'surface' => 'grass',
                'description' => 'Pristine natural grass maintained to All England Club standards — the fastest surface we offer.',
                'price' => 32
            ],
            [
                'name' => 'Indoor Arena',
                'surface' => 'indoor',
                'description' => 'Climate-controlled DecoTurf hard court with professional LED lighting — year-round, weather-free play.',
                'price' => 36
            ]]
        );
    }
}
