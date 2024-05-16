<?php

namespace App\Helpers;

class Dates
{
    /**
     * Clean the dates into french format
     * @throws \Exception
     */
    public static function clean($date, bool $wantHour = false): string
    {
        $instance = new \DateTimeImmutable($date);

        if($wantHour) {
            return $instance->format("d/m/Y H:i:s");
        } else {
            return $instance->format("d/m/Y");
        }

    }
}
