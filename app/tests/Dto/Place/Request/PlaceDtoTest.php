<?php

namespace App\Tests\Dto\Place\Request;

use App\Entity\Items;

use App\Tests\Builder\Dto\PackageDtoBuilder;
use App\Tests\Builder\Dto\PlaceDtoBuilder;
use App\Tests\Builder\Entity\ItemsBuilder;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PlaceDtoTest extends KernelTestCase
{
    public function testSuccess(): void
    {
        $PlaceDto = (new PlaceDtoBuilder($placeTitle = 'place', $qrCodeTitle =  '123'))->build();

        $this->assertEquals($placeTitle, $PlaceDto->getPlaceTitle());
        $this->assertEquals($qrCodeTitle, $PlaceDto->getQrCodeTitle());
    }

    public function testEmptyTitle(): void
    {
        $container = static::getContainer();
        $validator = $container->get(ValidatorInterface::class);

        $PlaceDto = (new PlaceDtoBuilder($placeTitle = '', $qrCodeTitle =  '123'))->build();
        $errors = $validator->validate($PlaceDto);

        $this->assertCount(1, $errors);
    }

    public function testEmptyQrCodeTitle(): void
    {
        $container = static::getContainer();
        $validator = $container->get(ValidatorInterface::class);

        $PlaceDto = (new PlaceDtoBuilder($placeTitle = 'place', $qrCodeTitle =  ''))->build();
        $errors = $validator->validate($PlaceDto);

        $this->assertCount(1, $errors);
        $this->assertTrue(true);
    }

}
