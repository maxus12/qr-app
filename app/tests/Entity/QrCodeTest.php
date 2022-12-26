<?php

namespace App\Tests\Entity;

use App\Tests\Builder\Entity\QrCodeBuilder;
use PHPUnit\Framework\TestCase;

class QrCodeTest extends TestCase
{
    public function testSuccess(): void
    {
        $qrCode = (new QrCodeBuilder($title = '123'))->build();

        $this->assertEquals($title, $qrCode->getTitle());
    }

}
