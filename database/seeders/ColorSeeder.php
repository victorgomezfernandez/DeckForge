<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            ['name' => 'White', 'code' => 'W'],
            ['name' => 'Blue', 'code' => 'U'],
            ['name' => 'Black', 'code' => 'B'],
            ['name' => 'Red', 'code' => 'R'],
            ['name' => 'Green', 'code' => 'G'],
            ['name' => 'Colorless', 'code' => 'C'],
            ['name' => 'X', 'code' => 'X'],
            ['name' => '0', 'code' => '0'],
            ['name' => '1', 'code' => '1'],
            ['name' => '2', 'code' => '2'],
            ['name' => '3', 'code' => '3'],
            ['name' => '4', 'code' => '4'],
            ['name' => '5', 'code' => '5'],
            ['name' => '6', 'code' => '6'],
            ['name' => '7', 'code' => '7'],
            ['name' => '8', 'code' => '8'],
            ['name' => '9', 'code' => '9'],
            ['name' => '10', 'code' => '10'],
            ['name' => '11', 'code' => '11'],
            ['name' => '12', 'code' => '12'],
            ['name' => '13', 'code' => '13'],
            ['name' => '14', 'code' => '14'],
            ['name' => '15', 'code' => '15'],
            ['name' => '16', 'code' => '16'],
            ['name' => '17', 'code' => '17'],
            ['name' => '18', 'code' => '18'],
            ['name' => '19', 'code' => '19'],
            ['name' => '20', 'code' => '20'],

            // Hybrid
            ['name' => 'White/Blue', 'code' => 'W/U'],
            ['name' => 'Blue/Black', 'code' => 'U/B'],
            ['name' => 'Black/Red', 'code' => 'B/R'],
            ['name' => 'Red/Green', 'code' => 'R/G'],
            ['name' => 'Green/White', 'code' => 'G/W'],
            ['name' => 'White/Black', 'code' => 'W/B'],
            ['name' => 'Blue/Red', 'code' => 'U/R'],
            ['name' => 'Black/Green', 'code' => 'B/G'],
            ['name' => 'Red/White', 'code' => 'R/W'],
            ['name' => 'Green/Blue', 'code' => 'G/U'],

            // Hybrid with generic
            ['name' => 'Generic/White', 'code' => '2/W'],
            ['name' => 'Generic/Blue', 'code' => '2/U'],
            ['name' => 'Generic/Black', 'code' => '2/B'],
            ['name' => 'Generic/Red', 'code' => '2/R'],
            ['name' => 'Generic/Green', 'code' => '2/G'],

            // Phyrexian
            ['name' => 'Phyrexian White', 'code' => 'W/P'],
            ['name' => 'Phyrexian Blue', 'code' => 'U/P'],
            ['name' => 'Phyrexian Black', 'code' => 'B/P'],
            ['name' => 'Phyrexian Red', 'code' => 'R/P'],
            ['name' => 'Phyrexian Green', 'code' => 'G/P'],

            //Hybrid Phyrexian
            ['name' => 'White/Blue Phyrexian', 'code' => 'W/U/P'],
            ['name' => 'Blue/Black Phyrexian', 'code' => 'U/B/P'],
            ['name' => 'Black/Red Phyrexian', 'code' => 'B/R/P'],
            ['name' => 'Red/Green Phyrexian', 'code' => 'R/G/P'],
            ['name' => 'Green/White Phyrexian', 'code' => 'G/W/P'],
            ['name' => 'White/Black Phyrexian', 'code' => 'W/B/P'],
            ['name' => 'Blue/Red Phyrexian', 'code' => 'U/R/P'],
            ['name' => 'Black/Green Phyrexian', 'code' => 'B/G/P'],
            ['name' => 'Red/White Phyrexian', 'code' => 'R/W/P'],
            ['name' => 'Green/Blue Phyrexian', 'code' => 'G/U/P'],

            //Snow
            ['name' => 'Snow', 'code' => 'S'],
        ];

        DB::table('colors')->insert($colors);
    }
}
