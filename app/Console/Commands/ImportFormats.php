<?php

namespace App\Console\Commands;

use App\Models\Format;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportFormats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-formats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import all the formats';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Fetching formats");
        $response = Http::get('https://api.scryfall.com/cards/search?q="Black Lotus"');

        if ($response->failed()) {
            $this->error("Failed to get the formats data");
            return;
        }

        $cardData = $response->json()['data'][0];

        $legalities = $cardData['legalities'];

        foreach ($legalities as $format => $status) {
            Format::firstOrCreate(['name' => $format]);
        }

        $this->info("Formats imported");
    }
}
