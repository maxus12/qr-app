<?php

namespace App\DataFixtures;

use App\Entity\ActionType;
use App\Entity\Items;
use App\Entity\Package;
use App\Entity\Place;
use App\Entity\QrCode;
use App\Repository\ItemsRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DataFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $qr11 = (new QrCode())->setTitle('11');
        $qr12 = (new QrCode())->setTitle('12');

        $place1 = (new Place())
            ->setTitle('place 11')
            ->setQrCode($qr11);
        $place2 = (new Place())
            ->setTitle('place 12')
            ->setQrCode($qr12);

        $itemsRepository = $manager->getRepository(Items::class);
        $item1 = $itemsRepository->findOneBy(['id' => 1684]);
        $item2 = $itemsRepository->findOneBy(['id' => 1876]);
        $item3 = $itemsRepository->findOneBy(['id' => 1397]);

        $qr21 = (new QrCode())->setTitle('21');
        $qr22 = (new QrCode())->setTitle('22');
        $qr23 = (new QrCode())->setTitle('23');

        $package1 = (new Package())
            ->setTitle('package '. $qr21->getTitle())
            ->setQrCode($qr21)
            ->setItems($item1)
            ->setQuantity(100);

        $package2 = (new Package())
            ->setTitle('package '. $qr22->getTitle())
            ->setQrCode($qr22)
            ->setItems($item2)
            ->setQuantity(100);

        $package3 = (new Package())
            ->setTitle('package '. $qr23->getTitle())
            ->setQrCode($qr23)
            ->setItems($item3)
            ->setQuantity(100);

        $manager->persist($qr11);
        $manager->persist($qr12);
        $manager->persist($qr21);
        $manager->persist($qr22);
        $manager->persist($qr23);
        $manager->persist($place1);
        $manager->persist($place2);
        $manager->persist($item1);
        $manager->persist($item2);
        $manager->persist($item3);
        $manager->persist($package1);
        $manager->persist($package2);
        $manager->persist($package3);

        $manager->flush();
    }
}
