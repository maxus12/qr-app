<?php

namespace App\Service;

use App\Entity\Package;
use App\Repository\PackageRepository;
use App\Exception\PackageDoesNotExistsException;

trait PackageTrait
{
    public function __construct(private PackageRepository $packageRepository)
    {
    }

    private function getPackageById(int $packageId): Package
    {
        $package = $this->packageRepository->findOneBy(['id' => $packageId]);
        if(null === $package) {
            throw new PackageDoesNotExistsException();
        }

        return $package;
    }
}
