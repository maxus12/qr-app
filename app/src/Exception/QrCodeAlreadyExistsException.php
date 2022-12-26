<?php

namespace App\Exception;

use RuntimeException;

class QrCodeAlreadyExistsException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct('The QR code already exists in database.');
    }
}
