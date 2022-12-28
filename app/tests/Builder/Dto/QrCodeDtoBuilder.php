<?php

namespace App\Tests\Builder\Dto;

use App\Dto\QrCode\Request\QrCodeDTO;

class QrCodeDtoBuilder
{
    private string $qrCodeTitle;

    public function __construct(string $qrCodeTitle = null)
    {
        $this->qrCodeTitle = $qrCodeTitle ?? '123';
    }

    public function build(): QrCodeDTO
    {
        $qrCodeDTO = new QrCodeDTO();
        $qrCodeDTO->setQrCode($this->qrCodeTitle);

        return $qrCodeDTO;
    }
}
