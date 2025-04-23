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
use Illuminate\Support\Facades\Http;

use function PHPUnit\Framework\isEmpty;

class ImportCards extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-cards';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import cards from the Scryfall API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //$url = "https://api.scryfall.com/cards/search?q=(set:lea OR set:leb OR set:2ed OR set:3ed OR set:4ed OR set:5ed OR set:6ed OR set:7ed OR set:8ed) (lang:en OR lang:es) unique:prints";
        //$url = "https://api.scryfall.com/cards/search?q=(set:lea OR set:leb OR set:3ed) lang:en unique:prints";
        $url = "https://api.scryfall.com/cards/search?q=lotho lang:es";
        $response = Http::get($url);

        if ($response->failed()) {
            $this->error("Failed to get the cards data");
            return;
        }

        $this->info("Fetching cards");

        $more = true;

        while ($more) {
            $cardsData = $response->json()['data'];

            foreach ($cardsData as $card) {
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

                $legalities = $card['legalities'];

                foreach ($legalities as $formatName => $legality) {
                    $format = Format::where('name', $formatName)->first();
                    Legality::firstOrCreate([
                        'card_id' => $createdCard['id'],
                        'format_id' => $format->id,
                        'name' => $legality
                    ]);
                }

                $keywords = $card['keywords'];

                if (sizeof($keywords) > 0) {
                    foreach ($keywords as $keywordName) {
                        $keyword = Keyword::firstOrCreate(['name' => $keywordName]);
                        $createdCard->keywords()->syncWithoutDetaching($keyword->id);
                    }
                }

                $colors = $card['colors'];

                if (sizeof($colors) > 0) {
                    foreach ($colors as $colorCode) {
                        $color = Color::where('code', $colorCode)->first();
                        $createdCard->colors()->syncWithoutDetaching($color->id);
                    }
                }

                $color_identities = $card['color_identity'];

                if (sizeof($color_identities) > 0) {
                    foreach ($color_identities as $single_color_identity) {
                        $color_identity = Color::where('code', $single_color_identity)->first();
                        $createdCard->color_identities()->syncWithoutDetaching($color_identity->id);
                    }
                }

                if ($card['layout'] == ('normal' || 'saga' || 'class')) {
                    if (
                        $card['lang'] == "es" && isset($card['printed_name']) &&
                        isset($card['printed_text'])
                    ) {
                        $createdCardDetails = CardDetails::firstOrCreate([
                            'name' => $card['printed_name'],
                            'power' => $card['power'] ?? null,
                            'toughness' => $card['toughness'] ?? null,
                            'loyalty' => $card['loyalty'] ?? null,
                            'defense' => $card['defense'] ?? null,
                            'oracle_text' => $card['printed_text'] ?? null,
                            'flavor_text' => $card['flavor_text'] ?? null,
                            'card_id' => $createdCard['id']
                        ]);
                    } elseif ($card['lang'] == "en") {
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
                        $manaCost = $card['mana_cost'];

                        preg_match_all('/\{([0-9A-Za-z\/]+)\}/', $manaCost, $matches);
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
            }

            if ($response->json('has_more')) {
                $nextPage = $response->json('next_page');
                $response = Http::get($nextPage);
            } else {
                $more = false;
            }
        }

        $this->info("Cards imported");
    }
}
