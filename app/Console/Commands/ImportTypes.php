<?php

namespace App\Console\Commands;

use App\Models\Type;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportTypes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-types';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all the card types from the Scryfall API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Fetching types");
        $endpoints = [
            'supertypes' => 'https://api.scryfall.com/catalog/supertypes',
            'card_types' => 'https://api.scryfall.com/catalog/card-types',
            'artifact_types' => 'https://api.scryfall.com/catalog/artifact-types',
            'battle_types' => 'https://api.scryfall.com/catalog/battle-types',
            'creature_types' => 'https://api.scryfall.com/catalog/creature-types',
            'enchantment_types' => 'https://api.scryfall.com/catalog/enchantment-types',
            'land_types' => 'https://api.scryfall.com/catalog/land-types',
            'planeswalker_types' => 'https://api.scryfall.com/catalog/planeswalker-types',
        ];

        foreach ($endpoints as $type => $url) {
            try {
                $response = Http::get($url);

                if ($response->successful()) {
                    $types = collect($response->json()['data']);
                    $this->info("Fetched $type");

                    foreach($types as $typeName) {
                        Type::firstOrCreate(['name' => $typeName]);
                    }

                } else {
                    $this->warn("Failed to fetch $type (HTTP {$response->status()})");
                }
            } catch (Exception $e) {
                $this->error("Error fetching type " . $e->getMessage());
            }
        }

        $this->info('Types imported');
    }
}
