<?php

namespace App\Model;

class PackageListResponse
{
    /**
     * @var PackageListItem[]
     */
    private array $items;

    /**
     * @param PackageListItem[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return PackageListItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
