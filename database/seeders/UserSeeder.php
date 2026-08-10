<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Jozef Adamec',
                'email' => 'jozo@gmail.com',
                'password' => Hash::make('jozo'),
                'role' => 'admin',
                'membership_id' => null
            ],
            [
                'name' => 'František Danko',
                'email' => 'fero@gmail.com',
                'password' => Hash::make('fero'),
                'role' => 'user',
                'membership_id' => null
            ],
            [
                'name' => 'Lukáš Fitoš',
                'email' => 'luki@gmail.com',
                'password' => Hash::make('luki'),
                'role' => 'user',
                'membership_id' => 1
            ]]
        );
    }
}
