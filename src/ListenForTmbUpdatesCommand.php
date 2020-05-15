<?php

namespace Dustycode\TmbTile;

use Illuminate\Console\Command;
use Spatie\Dashboard\Models\Tile;

class ListenForTmbUpdatesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dashboard:listen-tmb-updates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Listen for TMB updates of a given station';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $stations = config("dashboard.tiles.tmb.stations");

        if (is_null($stations)) {
            $this->error("There is no configuration");

            return -1;
        }

        foreach ($stations as $station) {
            $this->info("Listening for bus data on stations id: {$station}");


            $data = TmbClient::make()
                ->stopId($station)
                ->get();

            Tile::firstOrCreateForName("tmb")->putData("tmb_{$station}", $data);
        }
    }
}
