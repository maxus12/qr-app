<?php

namespace App\Tests\Entity;

use App\Entity\Items;
use App\Entity\QrCode;
use App\Tests\Builder\Entity\PackageBuilder;
use PHPUnit\Framework\TestCase;

class PackageTest extends TestCase
{
    public function testSuccess(): void
    {
        $package = (new PackageBuilder($title = 'package 1', $quantity = 100))->build();

        $this->assertEquals($title, $package->getTitle());
        $this->assertEquals($quantity, $package->getQuantity());
        $this->assertInstanceOf(QrCode::class, $package->getQrCode());
        $this->assertInstanceOf(Items::class, $package->getItems());
    }
}
