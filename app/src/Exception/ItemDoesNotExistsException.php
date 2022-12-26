<?php

namespace App\Exception;

use RuntimeException;

class ItemDoesNotExistsException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct('Item does not exists.');
    }
}
