<?php

namespace App\Helpers;

class Dates
{
    public static function clean($date) {
        $instance = new \DateTimeImmutable($date);
        return $instance->format("d/m/Y");
    }
}
