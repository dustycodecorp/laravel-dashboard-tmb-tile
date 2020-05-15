<?php

namespace Dustycode\TmbTile;

use Spatie\Dashboard\Models\Tile;

class TmbStore
{
    private Tile $tile;

    public static function make()
    {
        return new static();
    }

    public function __construct()
    {
        $this->tile = Tile::firstOrCreateForName("tmb");
    }

    public function dataForStopId($stopId)
    {
        return $this->tile->getData("tmb_{$stopId}");
    }
}
