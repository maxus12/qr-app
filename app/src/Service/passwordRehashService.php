<?php

namespace App\Service;

use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class passwordRehashService
{

    public function __construct(private EntityManagerInterface $em,
                                private UserPasswordHasherInterface $hasher,
                                private UsersRepository $usersRepository)
    {
    }

    public function rehash(): void
    {
        $users = $this->usersRepository->findBy(['password' => null]);
        foreach ($users AS $user) {
            if(null === $user->getPassword()){
                $user->setPassword($this->hasher->hashPassword($user, $user->getUserPassword()));
            }
        }
        $this->em->flush();
    }
}
