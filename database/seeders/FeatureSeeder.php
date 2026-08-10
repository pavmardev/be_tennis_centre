<?php

namespace Database\Seeders;

use App\Models\Court;
use App\Models\Feature;
use App\Models\Membership;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courts = Court::all();
        $memberships = Membership::all();

        $featurables = $memberships->concat($courts);

        if ($featurables->isEmpty()) {
            $featurables = Court::factory(3)->create()->concat(Membership::factory(3)->create());

        }

        $featurables->each(function ($featurable) {
            Feature::factory(2)->make()->each(function (Feature $feature) use ($featurable) {
                $feature->featureable()->associate($featurable);
                $feature->save();
            });
        });
    }
}
