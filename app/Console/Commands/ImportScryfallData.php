<?php

namespace App\Console\Commands;

use App\Models\Set;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportScryfallData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-scryfall-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get MTG info';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Fetching all the info");
        
        $this->call('app:import-sets');

        $this->call('app:import-formats');

        $this->call('app:import-cards');

        $this->call(\Database\Seeders\DeckSeeder::class);
        $this->call(\Database\Seeders\DeckCardSeeder::class);

        $this->info('Import finished');
    }
}
