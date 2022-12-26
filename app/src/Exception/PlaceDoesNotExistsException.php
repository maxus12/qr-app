<?php

namespace App\Exception;

use RuntimeException;

class PlaceDoesNotExistsException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct('Place does not exists.');
    }
}
