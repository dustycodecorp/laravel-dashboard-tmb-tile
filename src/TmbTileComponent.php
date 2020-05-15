<?php

namespace Dustycode\TmbTile;

use Livewire\Component;

class TmbTileComponent extends Component
{
    /** @var string */
    public $position;

    /** @var string|null */
    public $title;

    /** @var Int */
    public $stopId;

    public function mount(string $stopId, string $position, ?string $title = null)
    {
        $this->stopId = (int) $stopId;
        $this->position = $position;
        $this->title = $title;
    }

    public function render()
    {
        $config = config("dashboard.tiles.tmb");

        return view('dashboard-tmb-tile::tile', [
            'buses' => TmbStore::make()->dataForStopId($this->stopId),
            'refreshIntervalInSeconds' => $config['refresh_interval_in_seconds'] ?? 60,
        ]);
    }
}
