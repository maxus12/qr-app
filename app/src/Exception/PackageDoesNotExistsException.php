<?php

namespace App\Exception;

use RuntimeException;

class PackageDoesNotExistsException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct('package does not exists.');
    }
}
