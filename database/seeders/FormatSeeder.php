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
            ['name' => 'standard'],
            ['name' => 'future'],
            ['name' => 'historic'],
            ['name' => 'timeless'],
            ['name' => 'gladiator'],
            ['name' => 'pioneer'],
            ['name' => 'explorer'],
            ['name' => 'modern'],
            ['name' => 'legacy'],
            ['name' => 'pauper'],
            ['name' => 'vintage'],
            ['name' => 'penny'],
            ['name' => 'commander'],
            ['name' => 'oathbraker'],
            ['name' => 'standardbrawl'],
            ['name' => 'brawl'],
            ['name' => 'alchemy'],
            ['name' => 'paupercommander'],
            ['name' => 'duel'],
            ['name' => 'oldschool'],
            ['name' => 'permodern'],
            ['name' => 'predh'],
        ];

        DB::table('formats')->insert($formats);
    }
}
