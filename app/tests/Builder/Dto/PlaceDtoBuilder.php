<?php

namespace App\Tests\Builder\Dto;



use App\Dto\Place\Request\PlaceDTO;

class PlaceDtoBuilder
{
    private string $placeTitle;
    private string $qrCodeTitle;

    public function __construct(string $packageTitle = null, string $qrCodeTitle = null)
    {
        $this->placeTitle = $packageTitle ?? 'place 1';
        $this->qrCodeTitle = $qrCodeTitle ?? '123';
    }

    public function build(): PlaceDTO
    {
        $placeDto = new PlaceDTO();
        $placeDto->setPlaceTitle($this->placeTitle);
        $placeDto->setQrCodeTitle($this->qrCodeTitle);

        return $placeDto;
    }
}
