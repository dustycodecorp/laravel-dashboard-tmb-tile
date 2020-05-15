<?php

namespace Dustycode\TmbTile;

use Illuminate\Support\Facades\Http;

class TmbClient
{
    private $stopId;

    private $testMode = false;

    public static function make()
    {
        return new static();
    }

    public function stopId($stopId)
    {
        $this->stopId = $stopId;

        return $this;
    }

    public function get()
    {
        $url = "https://api.tmb.cat/v1/ibus/stops/{$this->stopId}";

        $queryString = [
            'app_id' => config("dashboard.tiles.tmb.app_id"),
            'app_key' => config("dashboard.tiles.tmb.app_key"),
        ];

        if ($this->testMode) {
            $results = file_get_contents(__DIR__ . "/../resources/stubs/data.json");
        } else {
            $results = Http::get($url, $queryString)
                        ->body();
        }

        if ($results) {
            return TmbParser::make($results)
                ->parse();
        }

        return [];
    }
}
