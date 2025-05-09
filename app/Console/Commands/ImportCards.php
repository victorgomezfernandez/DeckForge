<?php

namespace App\Console\Commands;

use App\Models\Card;
use App\Models\CardDetails;
use App\Models\Color;
use App\Models\Format;
use App\Models\Keyword;
use App\Models\Legality;
use App\Models\ManaCost;
use App\Models\Set;
use App\Models\Type;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;

class ImportCards extends Command
{
    protected $signature = 'app:import-cards';
    protected $description = 'Import cards from the Scryfall API';

    public function handle()
    {
        $url = "https://api.scryfall.com/cards/search?q=(set:lea OR set:leb OR set:2ed OR set:3ed OR set:4ed OR set:5ed OR set:6ed OR set:7ed OR set:8ed) (lang:en) unique:prints";
        //$url = "https://api.scryfall.com/cards/search?q=(set:lea) lang:en unique:prints";
        //$url = "https://api.scryfall.com/cards/search?q=wear//tear";
        $response = Http::get($url);

        if ($response->failed()) {
            $this->error("Failed to get the cards data");
            return;
        }

        $this->info("Fetching cards");
        $totalCards = $response->json()['total_cards'] ?? null;
        $bar = $this->output->createProgressBar($totalCards);
        $bar->start();

        $more = true;

        while ($more) {
            $cardsData = $response->json()['data'];

            foreach ($cardsData as $card) {

                if (
                    in_array($card['layout'], ['normal', 'saga', 'class']) &&
                    $card['lang'] === 'es' &&
                    (!isset($card['printed_name']) || !isset($card['printed_text']))
                ) {
                    continue;
                }

                $set = Set::where('code', $card['set'])->first();

                $createdCard = Card::firstOrCreate([
                    'collector_number' => $card['collector_number'],
                    'rarity' => $card['rarity'],
                    'img' => $card['image_uris']['large'],
                    'art_crop' => $card['image_uris']['art_crop'],
                    'layout' => $card['layout'],
                    'mana_value' => $card['cmc'],
                    'released_at' => $card['released_at'],
                    'oracle_id' => $card['oracle_id'],
                    'lang' => $card['lang'],
                    'set_id' => $set->id
                ]);

                foreach ($card['legalities'] as $formatName => $legality) {
                    $format = Format::where('name', $formatName)->first();
                    Legality::firstOrCreate([
                        'card_id' => $createdCard['id'],
                        'format_id' => $format->id,
                        'name' => $legality
                    ]);
                }

                foreach ($card['keywords'] as $keywordName) {
                    $keyword = Keyword::firstOrCreate(['name' => $keywordName]);
                    $createdCard->keywords()->syncWithoutDetaching($keyword->id);
                }

                foreach ($card['colors'] as $colorCode) {
                    $color = Color::where('code', $colorCode)->first();
                    $createdCard->colors()->syncWithoutDetaching($color->id);
                }

                foreach ($card['color_identity'] as $colorId) {
                    $color = Color::where('code', $colorId)->first();
                    $createdCard->color_identities()->syncWithoutDetaching($color->id);
                }

                if (in_array($card['layout'], ['normal', 'saga', 'class'])) {
                    if ($card['lang'] === 'es') {
                        $createdCardDetails = CardDetails::firstOrCreate([
                            'name' => $card['printed_name'],
                            'power' => $card['power'] ?? null,
                            'toughness' => $card['toughness'] ?? null,
                            'loyalty' => $card['loyalty'] ?? null,
                            'defense' => $card['defense'] ?? null,
                            'oracle_text' => $card['printed_text'],
                            'flavor_text' => $card['flavor_text'] ?? null,
                            'card_id' => $createdCard['id']
                        ]);
                    } else {
                        $createdCardDetails = CardDetails::firstOrCreate([
                            'name' => $card['name'],
                            'power' => $card['power'] ?? null,
                            'toughness' => $card['toughness'] ?? null,
                            'loyalty' => $card['loyalty'] ?? null,
                            'defense' => $card['defense'] ?? null,
                            'oracle_text' => $card['oracle_text'] ?? null,
                            'flavor_text' => $card['flavor_text'] ?? null,
                            'card_id' => $createdCard['id']
                        ]);
                    }

                    $typeLine = $card['type_line'];
                    $parts = explode(' — ', $typeLine);
                    $superAndTypes = explode(' ', trim($parts[0]));
                    $subTypes = isset($parts[1]) ? explode(' ', trim($parts[1])) : [];
                    $allTypes = array_merge($superAndTypes, $subTypes);

                    foreach ($allTypes as $typeName) {
                        $type = Type::firstOrCreate(['name' => $typeName]);
                        $createdCardDetails->types()->syncWithoutDetaching($type->id);
                    }

                    if (!empty($card['mana_cost'])) {
                        preg_match_all('/\{([0-9A-Za-z\/]+)\}/', $card['mana_cost'], $matches);
                        $manaSymbols = array_count_values($matches[1]);

                        foreach ($manaSymbols as $symbol => $count) {
                            $color = Color::where('code', $symbol)->first();
                            ManaCost::firstOrCreate([
                                'card_details_id' => $createdCardDetails->id,
                                'color_id' => $color->id,
                                'amount' => $count
                            ]);
                        }
                    }
                }
                $bar->advance();
            }

            if ($response->json('has_more')) {
                $response = Http::get($response->json('next_page'));
            } else {
                $more = false;
            }
        }

        $bar->finish();
        

    }
}
