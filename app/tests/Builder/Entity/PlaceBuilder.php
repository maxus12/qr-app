<?php

namespace App\Tests\Builder\Entity;

use App\Entity\Place;
use App\Entity\QrCode;

class PlaceBuilder
{
    private string $title;
    private QrCode $qrCode;

    public function __construct(?string $title = null, ?QrCode $qrCode = null)
    {
        $this->title = $title ?? 'place 1';
        $this->qrCode = $qrCode ?? (new QrCodeBuilder())->build();
    }

    public function build(): Place
    {
        return (new Place())
            ->setTitle($this->title)
            ->setQrCode($this->qrCode);
    }
}
