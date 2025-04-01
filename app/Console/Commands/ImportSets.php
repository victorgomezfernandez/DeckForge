<?php

namespace App\Console\Commands;

use App\Models\Set;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportSets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-sets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all MTG sets';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Fetching sets");
        $response = Http::get('https://api.scryfall.com/sets');

        if ($response->failed()) {
            $this->error("Failed to get sets data");
        }

        $sets = $response->json()['data'];

        foreach ($sets as $set) {
            Set::updateOrInsert(
                [
                    'name' => $set['name'],
                    'code' => $set['code'],
                    'symbol' => $set['icon_svg_uri'],
                    'release_date' => $set['released_at']
                ]
            );
        }

        $this->info("Sets imported");

    }
}
