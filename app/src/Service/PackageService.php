<?php

namespace App\Service;

use App\Dto\Package\Request\PackageDTO;
use App\Entity\Items;
use App\Entity\Package;
use App\Entity\PackageAction;
use App\Entity\Place;
use App\Entity\QrCode;
use App\Entity\ActionType;
use App\Exception\ItemDoesNotExistsException;
use App\Exception\PackageDoesNotExistsException;
use App\Exception\QrCodeAlreadyExistsException;
use App\Model\PackageActionList;
use App\Model\PackageListItem;
use App\Model\PackageListResponse;
use App\Model\PackageResponse;
use App\Repository\ActionTypeRepository;
use App\Repository\ItemsRepository;
use App\Repository\PackageActionRepository;
use App\Repository\PackageRepository;
use App\Repository\QrCodeRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class PackageService
{
//    use PackageTrait;

    public function __construct(
        private PackageRepository $packageRepository,
        private QrCodeRepository $qrCodeRepository,
        private ItemsRepository $itemsRepository,
        private PackageActionRepository $packageActionRepository,
        private ActionTypeRepository $actionTypeRepository,
        private EntityManagerInterface $em,
        private Security $security)
    {
    }

    public function getPackages(): PackageListResponse
    {
        $packages = $this->packageRepository->findBy([], ['title' => Criteria::ASC]);
        $items = array_map(
            fn (Package $package) => new PackageListItem(
                $package->getId(), $package->getTitle()
            ),
            $packages
        );

        return new PackageListResponse($items);
    }


    public function createPackage(PackageDTO $packageDTO): Package
    {
        if($this->qrCodeRepository->existsByTitle($packageDTO->getQrCodeTitle())) {
            throw new QrCodeAlreadyExistsException();
        }

        $item = $this->itemsRepository->findOneBy(['id' => $packageDTO->getItem()->getId()]);

        if(null === $item) {
            throw new ItemDoesNotExistsException();
        }

        $qrCode = (new QrCode())->setTitle($packageDTO->getQrCodeTitle());

        $package = (new Package())
            ->setTitle($packageDTO->getPackageTitle())
            ->setQrCode($qrCode)
            ->setItems($item);

        $packageAction = (new PackageAction())
            ->setPackage($package)
            ->setActionType($this->actionTypeRepository->findOneBy(['id' => 1]))
            ->setUser($this->security->getUser());

        $this->em->persist($qrCode);
        $this->em->persist($package);
        $this->em->persist($packageAction);
        $this->em->flush();

        return $package;
    }

    public function getPackageById(int $packageId): Package
    {
        $package = $this->packageRepository->findOneBy(['id' => $packageId]);
        if(null === $package) {
            throw new PackageDoesNotExistsException();
        }

        return $package;
    }

    public function getPackageActionsById(int $packageId): PackageActionList
    {
        $actions = $this->packageActionRepository->findBy(['package' => $packageId], ['createdAt' => Criteria::DESC], 10);

        return new PackageActionList($actions);
    }

    public function addToPackage(int $packageId, int $quantity, string $comment): void
    {
        $package = $this->getPackageById($packageId);
        $package->setQuantity($package->getQuantity() + $quantity);

        $packageAction = (new PackageAction())
            ->setPackage($package)
            ->setQuantity($quantity)
            ->setComment($comment)
            ->setActionType($this->actionTypeRepository->findOneBy(['id' => 2]))
            ->setUser($this->security->getUser());

        $this->em->persist($packageAction);
        $this->em->flush();
    }

    public function removeFromPackage(int $packageId, int $quantity, string $comment): void
    {
        $package = $this->getPackageById($packageId);
        $package->setQuantity($package->getQuantity() - $quantity);

        $packageAction = (new PackageAction())
            ->setPackage($package)
            ->setQuantity($quantity)
            ->setComment($comment)
            ->setActionType($this->actionTypeRepository->findOneBy(['id' => 3]))
            ->setUser($this->security->getUser());

        $this->em->persist($packageAction);
        $this->em->flush();
    }
}
