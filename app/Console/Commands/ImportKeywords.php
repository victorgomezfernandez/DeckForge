<?php

namespace App\Console\Commands;

use App\Models\Keyword;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportKeywords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-keywords';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import all the keywords';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Fetching keywords");
        $response = Http::get('https://api.scryfall.com/catalog/keyword-abilities');

        if ($response->failed()) {
            $this->error("Failed to get the keywords data");
            return;
        }

        $keywords = $response->json()['data'];

        foreach ($keywords as $keyword) {
            try {
                Keyword::firstOrCreate(['name' => $keyword]);
            } catch (Exception $e) {
                $this->error("Failed to import $keyword because" . $e->getMessage());
            }
        }

        $this->info("Keywords imported");
            
    }
}
