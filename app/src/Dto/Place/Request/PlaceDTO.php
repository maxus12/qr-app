<?php

namespace App\Dto\Place\Request;

use Symfony\Component\Validator\Constraints\NotBlank;

class PlaceDTO
{
    #[NotBlank]
    private string $qrCodeTitle;

    #[NotBlank]
    private string $placeTitle;

    public function getQrCodeTitle(): string
    {
        return $this->qrCodeTitle;
    }

    public function setQrCodeTitle(string $qrCodeTitle): void
    {
        $this->qrCodeTitle = $qrCodeTitle;
    }

    public function getPlaceTitle(): string
    {
        return $this->placeTitle;
    }

    public function setPlaceTitle(string $placeTitle): void
    {
        $this->placeTitle = $placeTitle;
    }

}
