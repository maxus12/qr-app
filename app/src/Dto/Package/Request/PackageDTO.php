<?php

namespace App\Dto\Package\Request;

use App\Entity\Items;
use Symfony\Component\Validator\Constraints\NotBlank;

class PackageDTO
{
    #[NotBlank]
    private string $qrCodeTitle;

    #[NotBlank]
    private string $packageTitle;

    #[NotBlank]
    private Items $item;

    /**
     * @return string
     */
    public function getQrCodeTitle(): string
    {
        return $this->qrCodeTitle;
    }

    /**
     * @param string $qrCodeTitle
     */
    public function setQrCodeTitle(string $qrCodeTitle): void
    {
        $this->qrCodeTitle = $qrCodeTitle;
    }

    /**
     * @return string
     */
    public function getPackageTitle(): string
    {
        return $this->packageTitle;
    }

    /**
     * @param string $packageTitle
     */
    public function setPackageTitle(string $packageTitle): void
    {
        $this->packageTitle = $packageTitle;
    }

    /**
     * @return Items
     */
    public function getItem(): Items
    {
        return $this->item;
    }

    /**
     * @param Items $item
     */
    public function setItem(Items $item): void
    {
        $this->item = $item;
    }

}
