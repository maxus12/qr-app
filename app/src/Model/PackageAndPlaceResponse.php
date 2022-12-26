<?php

namespace App\Model;

class PackageAndPlaceResponse
{
    private int $packageId;
    private int $placeId;

    public function __construct(int $packageId = 0, int $placeId = 0)
    {
        $this->packageId = $packageId;
        $this->placeId = $placeId;
    }

    public function getPackageId(): int
    {
        return $this->packageId;
    }

    public function getPlaceId(): int
    {
        return $this->placeId;
    }
}
