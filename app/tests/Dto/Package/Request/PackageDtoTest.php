<?php

namespace App\Tests\Dto\Package\Request;

use App\Dto\Package\Request\PlaceDTO;
use App\Entity\Items;

use App\Tests\Builder\Dto\PackageDtoBuilder;
use App\Tests\Builder\Entity\ItemsBuilder;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PackageDtoTest extends KernelTestCase
{
    public function testSuccess(): void
    {
        $packageDto = (new PackageDtoBuilder($packageTitle = 'package', $qrCodeTitle =  '123'))->build();

        $this->assertEquals($packageTitle, $packageDto->getPackageTitle());
        $this->assertEquals($qrCodeTitle, $packageDto->getQrCodeTitle());
        $this->assertInstanceOf(Items::class, $packageDto->getItem());
    }

    public function testEmptyTitle(): void
    {
        $container = static::getContainer();
        $validator = $container->get(ValidatorInterface::class);

        $packageDto = (new PackageDtoBuilder($packageTitle = '', $qrCodeTitle =  '123'))->build();
        $errors = $validator->validate($packageDto);

        $this->assertCount(1, $errors);
        $this->assertTrue(true);
    }

    public function testEmptyQrCodeTitle(): void
    {
        $container = static::getContainer();
        $validator = $container->get(ValidatorInterface::class);

        $packageDto = (new PackageDtoBuilder($packageTitle = 'package', $qrCodeTitle = ''))->build();
        $errors = $validator->validate($packageDto);

        $this->assertCount(1, $errors);
        $this->assertTrue(true);
    }

}
