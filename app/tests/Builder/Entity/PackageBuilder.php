<?php

namespace App\Tests\Builder\Entity;

use App\Entity\Items;
use App\Entity\Package;
use App\Entity\QrCode;

class PackageBuilder
{
    private string $packageTitle;
    private QrCode $qrCode;
    private Items $item;
    private int $quantity;

    public function __construct(
        ?string $packageTitle = null,
        ?int $quantity = null,
        ?QrCode $qrCode = null,
        ?Items $item = null)
    {
        $this->packageTitle = $packageTitle ?? 'package 1';
        $this->quantity = $quantity ?? 100;
        $this->qrCode = $qrCode ?? (new QrCodeBuilder())->build();
        $this->item = $item ?? (new ItemsBuilder())->build();
    }

    public function build(): Package
    {
        return (new Package())
            ->setTitle($this->packageTitle)
            ->setQrCode($this->qrCode)
            ->setItems($this->item)
            ->setQuantity($this->quantity);
    }


}
