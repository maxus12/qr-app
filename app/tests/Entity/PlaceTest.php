<?php

namespace App\Tests\Entity;

use App\Entity\QrCode;
use App\Tests\Builder\Entity\PlaceBuilder;
use PHPUnit\Framework\TestCase;

class PlaceTest extends TestCase
{
    public function testSuccess(): void
    {
        $place = (new PlaceBuilder($title = 'place 1'))->build();

        $this->assertEquals($title, $place->getTitle());
        $this->assertInstanceOf(QrCode::class, $place->getQrCode());
    }
}
