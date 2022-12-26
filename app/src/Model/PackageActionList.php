<?php

namespace App\Model;

use App\Entity\PackageAction;

class PackageActionList
{
    /**
     * @var PackageAction[]
     */
    private array $items;

    /**
     * @param PackageAction[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return PackageAction[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
