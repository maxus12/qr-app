<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Table(name: 'Users')]
#[ORM\Entity(repositoryClass: UsersRepository::class)]
#[ORM\UniqueConstraint(name: 'UserLogin', columns: ["UserLogin"])]
#[ORM\Index(columns: ['UserTypeId'], name: 'UserTypeId')]
class Users implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(name: 'UserLogin', length: 255)]
    private ?string $username = null;

    #[ORM\Column(name: 'UserPassword', length: 255, nullable: true)]
    private ?string $userPassword = null;

    #[ORM\Column(name: 'UserName', length: 255, nullable: true)]
    private ?string $fullName = null;

    #[ORM\Column(name: 'UserPhone', length: 255, nullable: true)]
    private ?string $userPhone = null;

    #[ORM\Column(name: 'UserEmail', length: 255, nullable: true)]
    private ?string $userEmail = null;

    /**
     * @ORM\Column(name="UserTypeId", type="integer", nullable=true)
     */
    #[ORM\Column(name: 'UserTypeId', nullable: true)]
    private ?int $userTypeId = null;

    #[ORM\Column(name: 'UserIsActive', nullable: true)]
    private ?int $userIsActive = null;

    #[ORM\Column(name: 'OrgId', nullable: true)]
    private ?int $orgId = null;

    #[ORM\Column(name: 'changeUserLogin', length: 255, nullable: true)]
    private ?string $changeUserLogin = null;

    #[ORM\Column(name: 'changeUserDatetime', type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $changeUserDatetime;

    #[ORM\Column(name: 'password', length: 255, nullable: true)]
    private ?string $password = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getUserPassword(): ?string
    {
        return $this->userPassword;
    }

    public function setUserPassword(?string $userPassword): self
    {
        $this->userPassword = $userPassword;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getUserPhone(): ?string
    {
        return $this->userPhone;
    }

    public function setUserPhone(?string $userPhone): self
    {
        $this->userPhone = $userPhone;

        return $this;
    }

    public function getUserEmail(): ?string
    {
        return $this->userEmail;
    }

    public function setUserEmail(?string $userEmail): self
    {
        $this->userEmail = $userEmail;

        return $this;
    }

    public function getUserTypeId(): ?int
    {
        return $this->userTypeId;
    }

    public function setUserTypeId(?int $userTypeId): self
    {
        $this->userTypeId = $userTypeId;

        return $this;
    }

    public function getUserIsActive(): ?int
    {
        return $this->userIsActive;
    }

    public function setUserIsActive(?int $userIsActive): self
    {
        $this->userIsActive = $userIsActive;

        return $this;
    }

    public function getOrgId(): ?int
    {
        return $this->orgId;
    }

    public function setOrgId(?int $orgId): self
    {
        $this->orgId = $orgId;

        return $this;
    }

    public function getChangeUserLogin(): ?string
    {
        return $this->changeUserLogin;
    }

    public function setChangeUserLogin(?string $changeUserLogin): self
    {
        $this->changeUserLogin = $changeUserLogin;

        return $this;
    }

    public function getChangeUserDatetime(): ?\DateTimeInterface
    {
        return $this->changeUserDatetime;
    }

    public function setChangeUserDatetime(?\DateTimeInterface $changeUserDatetime): self
    {
        $this->changeUserDatetime = $changeUserDatetime;

        return $this;
    }

    public function getRoles(): array
    {
        if($this->userIsActive){
            return ['ROLE_USER'];
        }
        return [];
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials(): void
    {
    }

    public function getUserIdentifier(): ?int
    {
        return $this->id;
    }

}
