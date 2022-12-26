<?php

namespace App\Service;

use App\Entity\QrCode;
use App\Model\PackageAndPlaceResponse;
use App\Repository\PackageRepository;
use App\Repository\QrCodeRepository;
use App\Repository\PlaceRepository;

class QrCodeService
{
    public function __construct(
        private QrCodeRepository $qrCodeRepository,
        private PackageRepository $packageRepository,
        private PlaceRepository $placeRepository)
    {
    }

    public function getPackageAndPlaceByQrCode(string $qrCodeTitle): PackageAndPlaceResponse
    {
        $qrCode = $this->qrCodeRepository->findOneBy(['title' => $qrCodeTitle]);
        if (null === $qrCode) {
            return new PackageAndPlaceResponse();
        }

        return new PackageAndPlaceResponse($this->getPackageId($qrCode), $this->getPlaceId($qrCode));
    }

    private function getPackageId(QrCode $qrCode): int
    {
        $package = $this->packageRepository->findOneBy(['qrCode' => $qrCode]);

        return (null === $package) ? 0 : $package->getId();
    }

    private function getPlaceId(QrCode $qrCode): int
    {
        $place = $this->placeRepository->findOneBy(['qrCode' => $qrCode]);

        return (null === $place) ? 0 : $place->getId();
    }
}
