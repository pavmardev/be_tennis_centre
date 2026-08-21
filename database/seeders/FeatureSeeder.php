<?php
namespace Database\Seeders;

use App\Models\Court;
use App\Models\Feature;
use App\Models\Membership;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Court::count() === 0) {
            Court::factory(3)->create();
        }

        if (Membership::count() === 0) {
            Membership::factory(3)->create();
        }

        $features = Feature::factory(6)->create();

        Court::all()->each(function (Court $court) use ($features) {
            $court->features()->attach(
                $features->random(rand(1, 3))->pluck('id')
            );
        });

        Membership::all()->each(function (Membership $membership) use ($features) {
            $membership->features()->attach(
                $features->random(rand(1, 2))->pluck('id')
            );
        });
    }
}
