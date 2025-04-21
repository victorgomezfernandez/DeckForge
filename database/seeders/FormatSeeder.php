<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $formats = [
            'Standard',
            'Future',
            'Historic',
            'Timeless',
            'Gladiator',
            'Pioneer',
            'Explorer',
            'Modern',
            'Legacy',
            'Pauper',
            'Vintage',
            'Penny',
            'Commander',
            'Oathbreaker',
            'Standardbrawl',
            'Brawl',
            'Alchemy',
            'Paupercommander',
            'Duel',
            'Oldschool',
            'Premodern',
            'Predh',
        ];

        foreach ($formats as $format) {
            DB::table('formats')->insert([
                'name' => $format
            ]);
        }
    }
}
