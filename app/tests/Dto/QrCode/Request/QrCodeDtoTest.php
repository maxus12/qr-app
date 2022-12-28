<?php

namespace App\Tests\Dto\QrCode\Request;

use App\Entity\Items;
use App\Tests\Builder\Dto\PackageDtoBuilder;
use App\Tests\Builder\Dto\QrCodeDtoBuilder;
use App\Tests\Builder\Entity\ItemsBuilder;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class QrCodeDtoTest extends KernelTestCase
{
    public function testSuccess(): void
    {
        $qrCodeDTO = (new QrCodeDtoBuilder($qrCodeTitle =  '123'))->build();

        $this->assertEquals($qrCodeTitle, $qrCodeDTO->getQrCode());
    }

    public function testWrong(): void
    {
        $container = static::getContainer();
        $validator = $container->get(ValidatorInterface::class);

        $qrCodeDTO = (new QrCodeDtoBuilder($qrCodeTitle = 'https://hello.com'))->build();
        $errors = $validator->validate($qrCodeDTO);

        $this->assertCount(1, $errors);
    }
}
