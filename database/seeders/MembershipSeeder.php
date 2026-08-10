<?php

namespace Database\Seeders;

use App\Models\Membership;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Membership::insert([
            [
                'name' => 'Bronze Plan',
                'cost' => 29,
                'duration' => 4,
            ],
            [
                'name' => 'Silver Plan',
                'cost' => 49,
                'duration' => 8,
            ],
            [
                'name' => 'Gold Plan',
                'cost' => 99,
                'duration' => null,
            ],
            [
                'name' => 'Senior Plan',
                'cost' => 69,
                'duration' => 12
            ]]
        );
    }
}
