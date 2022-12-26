<?php

namespace App\Tests\Builder\Dto;


use App\Dto\Package\Request\PackageDTO;
use App\Entity\Items;
use App\Tests\Builder\Entity\ItemsBuilder;

class PackageDtoBuilder
{
    private string $packageTitle;
    private string $qrCodeTitle;
    private Items $item;

    public function __construct(string $packageTitle = null, string $qrCodeTitle = null, Items $item = null)
    {
        $this->packageTitle = $packageTitle ?? 'package 1';
        $this->qrCodeTitle = $qrCodeTitle ?? '123';
        $this->item = $item ?? (new ItemsBuilder())->build();
    }

    public function build(): PackageDTO
    {
        $packageDto = new PackageDTO();
        $packageDto->setPackageTitle($this->packageTitle);
        $packageDto->setQrCodeTitle($this->qrCodeTitle);
        $packageDto->setItem($this->item);

        return $packageDto;
    }
}
