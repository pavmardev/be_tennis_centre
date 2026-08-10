<?php

namespace Database\Seeders;

use App\Models\Equipment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Equipment::insert([
            [
                'name' => 'Prenájom tenisovej rakety',
                'description' => 'Kvalitná pokročilá raketa (Wilson / Babolat) vhodná na tréning aj zápas.',
                'unicode' => '\u{1F3BE}',
                'price' => 5,
            ],
            [
                'name' => 'Dóza nových loptičiek (4 ks)',
                'description' => 'Nové tlakované loptičky značky Head Pro na tvrdý aj antukový povrch.',
                'unicode' => '\u{1F4E6}',
                'price' => 8,
            ],
            [
                'name' => 'Nahrávací stroj (1 hodina)',
                'description' => 'Automatický nahrávací kanón vrátane koša so 100 loptičkami pre samostatný tréning.',
                'unicode' => '\u{1F916}',
                'price' => 15,
            ],
            [
                'name' => 'Večerné osvetlenie kurtu',
                'description' => 'Príplatok za zapnutie LED osvetlenia kurtu na 1 hodinu.',
                'unicode' => '\u{1F4A1}',
                'price' => 4,
            ],
            [
                'name' => 'Zapožičanie uteráka',
                'description' => 'Čistý bavlnený športový uterák s vysokou savosťou.',
                'unicode' => '\u{1F9FA}',
                'price' => 2,
            ],
            [
                'name' => 'Protisklzová omotávka (Grip)',
                'description' => 'Kúpa a nalepenie novej omotávky na rúčku tenisovej rakety.',
                'unicode' => '\u{1F3F7}',
                'price' => 3.5,
            ]]
        );
    }
}
