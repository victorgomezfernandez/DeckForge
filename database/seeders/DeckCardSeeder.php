<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeckCardSeeder extends Seeder
{
    public function run(): void
    {
        // $deckCards = [
        //     'Goblins!' => [
        //         'Goblin Hero' => 4,
        //         'Goblin King' => 2,
        //         'Goblin Raider' => 4,
        //         'Goblin Chariot' => 4,
        //         'Goblin Balloon Brigade' => 4,
        //         'Mountain' => 15,
        //         'Lightning Bolt' => 4,
        //         'Fit of Rage' => 4,
        //         'Final Fortune' => 2,
        //         'Blaze' => 2,
        //         'Flashfires' => 2,
        //         'Panic Attack' => 4,
        //         'Spitting Earth' => 4,
        //         'Relentless Assault' => 2,
        //         'Wheel of Fortune' => 1,
        //         'Sol Ring' => 1,
        //         'Boil' => 1
        //     ],
        //     'Mono Black Control' => [
        //         'Hypnotic Specter' => 4,
        //         'Sengir Vampire' => 3,
        //         'Royal Assassin' => 3,
        //         'Dark Ritual' => 4,
        //         'Duress' => 4,
        //         'Drain Life' => 2,
        //         'Terror' => 4,
        //         'Nevinyrral\'s Disk' => 2,
        //         'Mind Twist' => 1,
        //         'Demonic Tutor' => 1,
        //         'Swamp' => 24,
        //         'Strip Mine' => 1,
        //         'Sol Ring' => 1,
        //         'Phyrexian Arena' => 2,
        //         'Black Knight' => 4,
        //     ],
        //     'White Weenies' => [
        //         'Glorious Anthem' => 4,
        //         'Serra Angel' => 2,
        //         'Swords to Plowshares' => 4,
        //         'Plains' => 25,
        //         'Sol Ring' => 1,
        //         'Angelic Page' => 4,
        //         'Armored Pegasus' => 4,
        //         'Castle' => 4,
        //         'Crusade' => 2,
        //         'Cloudchaser Eagle' => 2,
        //         'Disenchant' => 4,
        //         'Enlightened Tutor' => 2,
        //         'Glorious Anthem' => 3,
        //         'Hero\'s Resolve' => 3
        //     ],
        //     'Green Elves' => [
        //         'Elvish Archers' => 2,
        //         'Elvish Champion' => 4,
        //         'Elvish Piper' => 2,
        //         'Llanowar Elves' => 4,
        //         'Norwood Ranger' => 4,
        //         'Wood Elves' => 4,
        //         'Fyndhorn Elder' => 2,
        //         'Forest' => 24,
        //         'Nature\'s Lore' => 4,
        //         'Hurricane' => 2,
        //         'Monstrous Growth' => 2,
        //         'Giant Growth' => 2,
        //         'Fog' => 2,
        //         'Rampant Growth' => 2
        //     ],
        //     'Azorius Flyers' => [
        //         'Abbey Gargoyles' => 2,
        //         'Air Elemental' => 2,
        //         'Angelic Page' => 2,
        //         'Angel of Mercy' => 2,
        //         'Armored Pegasus' => 4,
        //         'Aven Cloudchaser' => 3,
        //         'Cloudchaser Eagle' => 1,
        //         'Diving Griffin' => 2,
        //         'Plains' => 12,
        //         'Island' => 12,
        //         'Ornithopter' => 2,
        //         'Serra Angel' => 2,
        //         'Ancestral Recall' => 1,
        //         'Sol Ring' => 1,
        //         'Mox Pearl' => 1,
        //         'Mox Emerald' => 1, 
        //         'Blessed Reversal' => 2,
        //         'Blue Elemental Blast' => 2,
        //         'Chill' => 2,
        //         'Castle' => 2,
        //         'Counterspell' => 2
        //     ],
        //     'Mono Green Stompy' => [
        //         'Ancient Silverback' => 4,
        //         'Birds of Paradise' => 4,
        //         'Bull Hippo' => 2,
        //         'Carnivorous Plant' => 2,
        //         'Llanowar Elves' => 4,
        //         'Craw Giant' => 2,
        //         'Craw Wurm' => 2,
        //         'Elvish Piper' => 4,
        //         'Forest' => 24,
        //         'Emperor Crocodile' => 2,
        //         'Nature\'s Lore' => 4,
        //         'Rampant Growth' => 4,
        //         'Giant Growth' => 2
        //     ],
        //     'Rakdos Midrange' => [
        //         'Ball Lightning' => 4,
        //         'Balduvian Horde' => 2,
        //         'Black Knight' => 4,
        //         'Blood Pet' => 4,
        //         'Bog Imp' => 2,
        //         'Deathgazer' => 4,
        //         'Drudge Skeletons' => 2,
        //         'Fire Drake' => 2,
        //         'Mountain' => 12,
        //         'Swamp' => 12, 
        //         'Dark Ritual' => 2,
        //         'Fatal Blow' => 2,
        //         'Lightning Bolt' => 4,
        //         'Shatter' => 2,
        //         'Slay' => 2
        //     ],
        //     'Simic Ramp' => [
        //         'Llanowar Elves' => 4,
        //         'Birds of Paradise' => 4,
        //         'Craw Giant' => 2,
        //         'Craw Wurm' => 2,
        //         'Wood Elves' => 4,
        //         'Hurricane' => 2,
        //         'Forest' => 14,
        //         'Island' => 10,
        //         'Giant Tortoise' => 2,
        //         'Nature\'s Lore' =>4,
        //         'Rampant Growth' =>4,
        //         'Johtull Wurm' => 3,
        //         'Island Fish Jasconius' => 1,
        //         'Leviathan' => 2,
        //         'Merchant of Secrets' => 2
        //     ],
        //     'Izzet Spells' => [
        //         'Blaze' => 2,
        //         'Demolish' => 2,
        //         'Ancestral Recall' => 1,
        //         'Flashfires' => 2,
        //         'Lightning Bolt' => 4,
        //         'Time Walk' => 1,
        //         'Volcanic Eruption' => 2,
        //         'Volcanic Hammer' => 2,
        //         'Island' => 12,
        //         'Mountain' => 12,
        //         'Counterspell' => 4,
        //         'Deflection' => 2,
        //         'Hibernation' => 2,
        //         'Remove Soul'  => 2,
        //         'Apprentice Wizard' => 2,
        //         'Ball Lightning' => 4,
        //         'Sol Ring' => 1,
        //         'Mox Ruby' => 1,
        //         'Coral Eel' => 2
        //     ],
        //     'Gruul Stompy' => [
        //         'Ambush Party' => 2,
        //         'Ancient Silverback' => 2,
        //         'Ball Lightning' => 2,
        //         'Birds of Paradise' => 4,
        //         'Carnivorous Plant' => 2,
        //         'Dragon Whelp' => 2,
        //         'Elvish Piper' => 4,
        //         'Enormous Baloth' => 2,
        //         'Forest' => 13,
        //         'Mountain' => 13,
        //         'Rampant Growth' => 4,
        //         'Kird Ape' => 2,
        //         'Lightning Elemental' => 2,
        //         'Llanowar Elves' => 2,
        //         'Giant Growth' => 4,
        //     ],
        //     'Orzhov Lifegain' => [
        //         'Angel of Mercy' => 4,
        //         'Black Knight' => 4,
        //         'Bog Imp' => 2,
        //         'Avatar of Hope' => 2,
        //         'Venerable Monk' => 4,
        //         'Staunch Defenders' => 2,
        //         'Blessed Reversal' => 3,
        //         'Blessed Wine' => 4,
        //         'Chastise' => 2,
        //         'Exile' => 2,
        //         'Vampiric Tutor' => 1,
        //         'Plains' => 13,
        //         'Swamp' => 13,
        //         'Caribou Range' => 2,
        //         'Sanctimony' => 2,
        //     ],
        //     'Dimir Control' => [
        //         'Blood Pet' => 4,
        //         'Clone' => 2,
        //         'Coral Eel' => 4,
        //         'Dandân' => 4,
        //         'Drudge Skeletons' => 2,
        //         'Glacial Wall' => 2,
        //         'Merchant of Secrets' => 4,
        //         'Island' => 16,
        //         'Swamp' => 10,
        //         'Counterspell' => 4,
        //         'Ancestral Recall' => 1,
        //         'Dark Ritual' => 2,
        //         'Deflection' => 2,
        //         'Evacuation' => 1,
        //         'Execute' => 2
        //     ],
        // ];

        // $deckIds = DB::table('decks')
        //     ->whereIn('name', array_keys($deckCards))
        //     ->pluck('id', 'name');

        // foreach ($deckCards as $deckName => $cards) {
        //     $deckId = $deckIds[$deckName];

        //     foreach ($cards as $cardName => $count) {
        //         $cardDetail = DB::table('card_details')
        //             ->where('name', $cardName)
        //             ->first();

        //         if (!$cardDetail) {
        //             $this->command->warn("Card detail not found: {$cardName}");
        //             continue;
        //         }

        //         $cardId = $cardDetail->card_id;

        //         if (!$cardId) {
        //             $this->command->warn("No card_id found in card_detail: {$cardName}");
        //             continue;
        //         }

        //         for ($i = 0; $i < $count; $i++) {
        //             DB::table('cards_deck')->insert([
        //                 'card_id' => $cardId,
        //                 'deck_id' => $deckId,
        //             ]);
        //         }
        //     }
        // }
    }
}
