<?php

namespace App\Service;

use App\Dto\Place\Request\PlaceDTO;
use App\Entity\Package;
use App\Entity\Place;
use App\Entity\PlaceAction;
use App\Entity\QrCode;
use App\Exception\PackageDoesNotExistsException;
use App\Exception\PlaceDoesNotExistsException;
use App\Exception\QrCodeAlreadyExistsException;
use App\Model\PlaceActionList;
use App\Model\PlaceListItem;
use App\Model\PlaceListResponse;
use App\Model\PlaceResponse;
use App\Repository\ActionTypeRepository;
use App\Repository\PackageRepository;
use App\Repository\PlaceActionRepository;
use App\Repository\PlaceRepository;
use App\Repository\QrCodeRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class PlaceService
{
    use PackageTrait;

    public function __construct(
        private PlaceRepository $placeRepository,
        private PackageRepository $packageRepository,
        private QrCodeRepository $qrCodeRepository,
        private PlaceActionRepository $placeActionRepository,
        private ActionTypeRepository $actionTypeRepository,
        private EntityManagerInterface $em,
        private Security $security)
    {
    }

    public function getPlaces(): PlaceListResponse
    {
        $places = $this->placeRepository->findBy([], ['title' => Criteria::ASC]);
        $items = array_map(
            fn (Place $place) => new PlaceListItem(
                $place->getId(), $place->getTitle()
            ),
            $places
        );

        return new PlaceListResponse($items);
    }

    public function createPlace(PlaceDTO $placeDTO): Place
    {
        if($this->qrCodeRepository->existsByTitle($placeDTO->getQrCodeTitle())) {
            throw new QrCodeAlreadyExistsException();
        }

        $qrCode = (new QrCode())->setTitle($placeDTO->getQrCodeTitle());

        $place = (new Place())
            ->setTitle($placeDTO->getPlaceTitle())
            ->setQrCode($qrCode);

        $placeAction = (new PlaceAction())
            ->setPlace($place)
            ->setActionType($this->actionTypeRepository->findOneBy(['id' => 1]))
            ->setUser($this->security->getUser());

        $this->em->persist($qrCode);
        $this->em->persist($place);
        $this->em->persist($placeAction);
        $this->em->flush();

        return $place;
    }

    public function addPackageToPlace(int $placeId, int $packageId, string $comment): void
    {
        $place = $this->getPlaceById($placeId);
        $package = $this->getPackageById($packageId);
        $place->addPackage($package);

        $placeAction = (new PlaceAction())
            ->setPlace($place)
            ->setPackage($package)
            ->setComment($comment)
            ->setActionType($this->actionTypeRepository->findOneBy(['id' => 2]))
            ->setUser($this->security->getUser());

        $this->em->persist($placeAction);
        $this->em->flush();
    }

    public function removePackageFromPlace(int $placeId, int $packageId, string $comment): void
    {
        $place = $this->getPlaceById($placeId);
        $package = $this->getPackageById($packageId);
        $place->removePackage($package);

        $placeAction = (new PlaceAction())
            ->setPlace($place)
            ->setPackage($package)
            ->setComment($comment)
            ->setActionType($this->actionTypeRepository->findOneBy(['id' => 3]))
            ->setUser($this->security->getUser());

        $this->em->persist($placeAction);
        $this->em->flush();
    }

    public function getPlaceById(int $placeId): Place
    {
        $place = $this->placeRepository->findOneBy(['id' => $placeId]);
        if(null === $place) {
            throw new PlaceDoesNotExistsException();
        }

        return $place;
    }

    public function getPlaceActionsById(int $placeId): PlaceActionList
    {
        $actions = $this->placeActionRepository->findBy(['place' => $placeId], ['createdAt' => Criteria::DESC], 10);

        return new PlaceActionList($actions);
    }

}
