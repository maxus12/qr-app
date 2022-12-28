<?php

namespace App\Entity;

use App\Repository\ItemsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;

#[ORM\Entity(repositoryClass: ItemsRepository::class)]
#[ORM\Table(name: 'Items', )]
#[ORM\Index(columns: ['ItemTypeId'], name: 'ItemTypeId')]
#[ORM\Index(columns: ['UserLogin'], name: 'UserLogin')]
class Items
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
//    #[ORM\Column(name: "ID")]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: 'ItemName', length: 255, nullable: true)]
    private ?string $itemName = null;

    #[ORM\Column(name: 'AltName1', length: 255, nullable: true)]
    private ?string $altName1 = null;

    #[ORM\Column(name: 'AltName2', length: 255, nullable: true)]
    private ?string $altName2 = null;

    #[ORM\Column(name: 'AltName3', length: 255, nullable: true)]
    private ?string $altName3 = null;

    #[ORM\Column(name: 'ItemTypeId', nullable: true)]
    private ?int $itemTypeId = null;

    #[ORM\Column(name: 'ItemLocation', length: 255, nullable: true)]
    private ?string $itemLocation = null;

    #[ORM\Column(name: 'ItemCount', nullable: true)]
    private ?int $itemCount = null;

    #[ORM\Column(name: 'Remainder', nullable: true)]
    private ?int $remainder = 0;

    #[ORM\Column(name: 'ItemPrice', nullable: true)]
    private ?int $itemPrice = null;

    #[ORM\Column(name: 'ModuleId', nullable: true)]
    private ?int $moduleId = null;

    /**
     * @ORM\Column(name="ItemIsActive", type="integer", nullable=true)
     */
    #[ORM\Column(name: 'ItemIsActive', nullable: true)]
    private ?int $itemIsActive = null;

    /**
     * @ORM\Column(name="SupplierId", type="integer", nullable=true)
     */
    #[ORM\Column(name: 'SupplierId', nullable: true)]
    private ?int $supplierId = null;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="AccountDate", type="date", nullable=true)
     */
    #[ORM\Column(name: 'AccountDate', type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $accountDate = null;

    /**
     * @ORM\Column(name="Notes", type="string", length=255, nullable=true)
     */
    #[ORM\Column(name: 'Notes', length: 255, nullable: true)]
    private ?string $notes = null;

    /**
     * @ORM\Column(name="AccountName", type="string", length=255, nullable=true)
     */
    #[ORM\Column(name: 'AccountName', length: 255, nullable: true)]
    private ?string $accountName = null;

    /**
     * @ORM\Column(name="AccountCount", type="integer", nullable=true)
     */
    #[ORM\Column(name: 'AccountCount', nullable: true)]
    private ?int $accountCount = null;

    /**
     * @ORM\Column(name="AccountPrice", type="decimal", precision=10, scale=2, nullable=true)
     */
    #[ORM\Column(name: 'AccountPrice', type: 'decimal', precision: 10, scale: 2, nullable: true)]
    private ?float $accountPrice = null;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="PaidDate", type="date", nullable=true)
     */
    #[ORM\Column(name: 'PaidDate', type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $paidDate = null;

    /**
     * @ORM\Column(name="IsPaid", type="integer", nullable=true)
     */
    #[ORM\Column(name: 'IsPaid', nullable: true)]
    private ?int $isPaid = null;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="ExpectedDate", type="date", nullable=true)
     */
    #[ORM\Column(name: 'ExpectedDate', type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $expectedDate = null;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="InvoiceDate", type="date", nullable=true)
     */
    #[ORM\Column(name: 'InvoiceDate', type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $invoiceDate = null;

    /**
     * @ORM\Column(name="InvoiceName", type="string", length=255, nullable=true)
     */
    #[ORM\Column(name: 'InvoiceName', length: 255, nullable: true)]
    private ?string $invoiceName = null;

    /**
     * @ORM\Column(name="ReceivedCount", type="integer", nullable=true)
     */
    #[ORM\Column(name: 'ReceivedCount', nullable: true)]
    private ?int $receivedCount = null;

    /**
     * @ORM\Column(name="SetNeedCount", type="integer", nullable=true)
     */
    #[ORM\Column(name: 'SetNeedCount', nullable: true)]
    private ?int $setNeedCount = null;

    /**
     * @ORM\Column(name="UserLogin", type="string", length=255, nullable=true)
     */
    #[ORM\Column(name: 'UserLogin', nullable: true)]
    private ?string $userLogin = null;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="UserDatetime", type="datetime", nullable=true)
     */
    #[ORM\Column(name: 'UserDatetime', type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $userDatetime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getItemName(): ?string
    {
        return $this->itemName;
    }

    public function setItemName(?string $itemName): self
    {
        $this->itemName = $itemName;

        return $this;
    }

    public function getAltName1(): ?string
    {
        return $this->altName1;
    }

    public function setAltName1(?string $altName1): self
    {
        $this->altName1 = $altName1;

        return $this;
    }

    public function getAltName2(): ?string
    {
        return $this->altName2;
    }

    public function setAltName2(?string $altName2): self
    {
        $this->altName2 = $altName2;

        return $this;
    }

    public function getAltName3(): ?string
    {
        return $this->altName3;
    }

    public function setAltName3(?string $altName3): self
    {
        $this->altName3 = $altName3;

        return $this;
    }

    public function getItemTypeId(): ?int
    {
        return $this->itemTypeId;
    }

    public function setItemTypeId(?int $itemTypeId): self
    {
        $this->itemTypeId = $itemTypeId;

        return $this;
    }

    public function getItemLocation(): ?string
    {
        return $this->itemLocation;
    }

    public function setItemLocation(?string $itemLocation): self
    {
        $this->itemLocation = $itemLocation;

        return $this;
    }

    public function getItemCount(): ?int
    {
        return $this->itemCount;
    }

    public function setItemCount(?int $itemCount): self
    {
        $this->itemCount = $itemCount;

        return $this;
    }

    public function getRemainder(): ?int
    {
        return $this->remainder;
    }

    public function setRemainder(?int $remainder): self
    {
        $this->remainder = $remainder;

        return $this;
    }

    public function getItemPrice(): ?int
    {
        return $this->itemPrice;
    }

    public function setItemPrice(?int $itemPrice): self
    {
        $this->itemPrice = $itemPrice;

        return $this;
    }

    public function getModuleId(): ?int
    {
        return $this->moduleId;
    }

    public function setModuleId(?int $moduleId): self
    {
        $this->moduleId = $moduleId;

        return $this;
    }

    public function getItemIsActive(): ?int
    {
        return $this->itemIsActive;
    }

    public function setItemIsActive(?int $itemIsActive): self
    {
        $this->itemIsActive = $itemIsActive;

        return $this;
    }

    public function getSupplierId(): ?int
    {
        return $this->supplierId;
    }

    public function setSupplierId(?int $supplierId): self
    {
        $this->supplierId = $supplierId;

        return $this;
    }

    public function getAccountDate(): ?\DateTimeInterface
    {
        return $this->accountDate;
    }

    public function setAccountDate(?\DateTimeInterface $accountDate): self
    {
        $this->accountDate = $accountDate;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }

    public function getAccountName(): ?string
    {
        return $this->accountName;
    }

    public function setAccountName(?string $accountName): self
    {
        $this->accountName = $accountName;

        return $this;
    }

    public function getAccountCount(): ?int
    {
        return $this->accountCount;
    }

    public function setAccountCount(?int $accountCount): self
    {
        $this->accountCount = $accountCount;

        return $this;
    }

    public function getAccountPrice(): ?float
    {
        return $this->accountPrice;
    }

    public function setAccountPrice(?float $accountPrice): self
    {
        $this->accountPrice = $accountPrice;

        return $this;
    }

    public function getPaidDate(): ?\DateTimeInterface
    {
        return $this->paidDate;
    }

    public function setPaidDate(?\DateTimeInterface $paidDate): self
    {
        $this->paidDate = $paidDate;

        return $this;
    }

    public function getIsPaid(): ?int
    {
        return $this->isPaid;
    }

    public function setIsPaid(?int $isPaid): self
    {
        $this->isPaid = $isPaid;

        return $this;
    }

    public function getExpectedDate(): ?\DateTimeInterface
    {
        return $this->expectedDate;
    }

    public function setExpectedDate(?\DateTimeInterface $expectedDate): self
    {
        $this->expectedDate = $expectedDate;

        return $this;
    }

    public function getInvoiceDate(): ?\DateTimeInterface
    {
        return $this->invoiceDate;
    }

    public function setInvoiceDate(?\DateTimeInterface $invoiceDate): self
    {
        $this->invoiceDate = $invoiceDate;

        return $this;
    }

    public function getInvoiceName(): ?string
    {
        return $this->invoiceName;
    }

    public function setInvoiceName(?string $invoiceName): self
    {
        $this->invoiceName = $invoiceName;

        return $this;
    }

    public function getReceivedCount(): ?int
    {
        return $this->receivedCount;
    }

    public function setReceivedCount(?int $receivedCount): self
    {
        $this->receivedCount = $receivedCount;

        return $this;
    }

    public function getSetNeedCount(): ?int
    {
        return $this->setNeedCount;
    }

    public function setSetNeedCount(?int $setNeedCount): self
    {
        $this->setNeedCount = $setNeedCount;

        return $this;
    }

    public function getUserLogin(): ?string
    {
        return $this->userLogin;
    }

    public function setUserLogin(?string $userLogin): self
    {
        $this->userLogin = $userLogin;

        return $this;
    }

    public function getUserDatetime(): ?\DateTimeInterface
    {
        return $this->userDatetime;
    }

    public function setUserDatetime(?\DateTimeInterface $userDatetime): self
    {
        $this->userDatetime = $userDatetime;

        return $this;
    }
}
