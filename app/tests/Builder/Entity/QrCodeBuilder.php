<?php

namespace App\Tests\Builder\Entity;

use App\Entity\QrCode;

class QrCodeBuilder
{
    private string $title;

    public function __construct($title = '12345')
    {
        $this->title = $title;
    }

    public function build(): QrCode
    {
        return (new QrCode())->setTitle($this->title);
    }

}
