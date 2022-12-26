<?php

namespace App\DataFixtures;

use App\Entity\ActionType;
use App\Entity\Package;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $actionTypeCreate = (new ActionType())->setTitle('Создание');
        $actionTypeAdd = (new ActionType())->setTitle('Добавление');
        $actionTypeRemove = (new ActionType())->setTitle('Удаление');

        $manager->persist($actionTypeCreate);
        $manager->persist($actionTypeAdd);
        $manager->persist($actionTypeRemove);
        $manager->flush();

    }
}
