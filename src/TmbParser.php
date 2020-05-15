<?php

namespace Dustycode\TmbTile;

class TmbParser
{

    private $stopData;

    private $busData = [];

    /**
     * TmbParser constructor.
     * @param $stopData
     */
    public function __construct($stopData)
    {
        $this->stopData = $stopData;
    }

    public static function make($list)
    {
        return new static($list);
    }

    public function parse()
    {
        $this->stopData = json_decode($this->stopData);

        return $this->getStopInfo();
    }

    private function getStopInfo()
    {
        if ($this->stopData->status != "success") {
            $this->busData;
        }

        if (isset($this->stopData->data)) {
            $ibus = $this->stopData->data->ibus;

            if (count($ibus) < 1) {
                return $this->busData;
            }

            foreach ($ibus as $busInfo) {
                $busInfo->lineColor = $this->addLineColor($busInfo->line);
                $busInfo->timeColor = $this->addTimeColor($busInfo->{'t-in-min'});
                $this->busData[] = $busInfo;
            }
        }

        return $this->busData;
    }

    private function addLineColor($line)
    {
        switch ($line) {
            case strpos($line, 'H'):
                $color = '#009ee0';
                break;
            case strpos($line, 'V'):
                $color = '#6ab023';
                break;
            case strpos($line, 'D'):
                $color = '#93117e';
                break;
            case strpos($line, 'N'):
                $color = '#3366cc';
                break;
            default:
                $color = '#DC241F';
                break;
        }

        return $color;
    }

    private function addTimeColor($time)
    {
        if ($time >= 5) {
            $color = 'text-green-600';
        } elseif ($time < 5 && $time >= 3) {
            $color = 'text-yellow-600';
        } elseif ($time < 3) {
            $color = 'text-red-600';
        } else {
            $color = 'text-black-600';
        }

        return $color;
    }
}
