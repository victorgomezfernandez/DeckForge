<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $decks = [
            ['name'=>'Goblins!', 'description'=>'Aggro Red Goblins', 'img'=>'https://cards.scryfall.io/art_crop/front/c/3/c3ed9cd3-5e6a-4e86-b120-ff27b744311d.jpg?1645131243', 'public'=>true, 'format_id'=>11,'user_id'=>5],
            ['name'=>'Mono Black Control', 'description'=>'Classic control with discard and kill spells', 'img'=>'https://cards.scryfall.io/art_crop/front/c/1/c1662949-0d69-49a3-8c69-daf10717ed4e.jpg?1559591323', 'public'=>true, 'format_id'=>11, 'user_id'=>3],
            ['name'=>'White Weenies', 'description'=>'Small white creatures with buffs', 'img'=>'https://cards.scryfall.io/art_crop/front/1/1/11600105-56c6-4073-a4a6-8469030b39c9.jpg?1559591360', 'public'=>true, 'format_id'=>11, 'user_id'=>7],
            ['name'=>'Dimir Control', 'description'=>'Blue-black control with counterspells and removal', 'img'=>'https://cards.scryfall.io/art_crop/front/1/9/19577bda-2728-40c8-a262-26051e6c226b.jpg?1562233741', 'public'=>true, 'format_id'=>11, 'user_id'=>1],
            ['name'=>'Green Elves', 'description'=>'Green ramp elves', 'img'=>'https://cards.scryfall.io/art_crop/front/8/8/88c329c4-6c40-467a-ab37-95896a0c1159.jpg?1687904249', 'public'=>true, 'format_id'=>11, 'user_id'=>8],
            ['name'=>'Rakdos Midrange', 'description'=>'Aggressive black-red deck with removal', 'img'=>'https://cards.scryfall.io/art_crop/front/5/3/53834370-845c-4677-b665-e556eae8f9de.jpg?1562237926', 'public'=>true, 'format_id'=>11, 'user_id'=>9],
            ['name'=>'Azorius Flyers', 'description'=>'Blue-white flying creatures and tempo', 'img'=>'https://cards.scryfall.io/art_crop/front/8/1/81cd5854-56ef-48ec-ad12-1690fa45b4a5.jpg?1562241673', 'public'=>true, 'format_id'=>11, 'user_id'=>4],
            ['name'=>'Simic Ramp', 'description'=>'Green-blue ramp into big threats', 'img'=>'https://cards.scryfall.io/art_crop/front/2/6/263feecf-a657-4892-a2bb-cd7080d283c2.jpg?1562234514', 'public'=>true, 'format_id'=>11, 'user_id'=>3],
            ['name'=>'Gruul Stompy', 'description'=>'Aggressive red-green deck with big creatures', 'img'=>'https://cards.scryfall.io/art_crop/front/e/0/e06bea52-3db1-4b61-8418-77ace9cd70b5.jpg?1562249463', 'public'=>true, 'format_id'=>11, 'user_id'=>3],
            ['name'=>'Izzet Spells', 'description'=>'Blue-red deck focusing on instants and sorceries', 'img'=>'https://cards.scryfall.io/art_crop/front/9/5/9521375e-0bc1-45ef-b513-6d332a25f9d2.jpg?1559604172', 'public'=>true, 'format_id'=>11, 'user_id'=>5],
            ['name'=>'Orzhov Lifegain', 'description'=>'Black-white deck with lifegain synergies', 'img'=>'https://cards.scryfall.io/art_crop/front/1/c/1cb3eddb-cd89-4cec-92b4-4006dece36a8.jpg?1562900696', 'public'=>true, 'format_id'=>11, 'user_id'=>2],
            ['name'=>'Mono Green Stompy', 'description'=>'Classic green big creatures and pump', 'img'=>'https://cards.scryfall.io/art_crop/front/0/c/0ccdc9d7-71b5-4304-8d19-a63952e17a6b.jpg?1562897615', 'public'=>true, 'format_id'=>11, 'user_id'=>1],
        ];

        DB::table('decks')->insert($decks);

        $deckColors = [
            'Goblins!' => [4],
            'Mono Black Control' => [3],
            'White Weenies' => [1],
            'Dimir Control' => [2, 3],
            'Green Elves' => [5],
            'Rakdos Midrange' => [3, 4],
            'Azorius Flyers' => [1, 2],
            'Simic Ramp' => [2, 5],
            'Gruul Stompy' => [4, 5],
            'Izzet Spells' => [2, 4],
            'Orzhov Lifegain' => [1, 3],
            'Mono Green Stompy' => [5],
        ];
        
        $deckIds = DB::table('decks')
            ->whereIn('name', array_keys($deckColors))
            ->pluck('id', 'name');
        
        $colorDeckRelations = [];
        
        foreach ($deckColors as $deckName => $colors) {
            $deckId = $deckIds[$deckName];
            foreach ($colors as $colorId) {
                $colorDeckRelations[] = [
                    'deck_id' => $deckId,
                    'color_id' => $colorId
                ];
            }
        }
    
        DB::table('deck_colors')->insert($colorDeckRelations);
    }
}
