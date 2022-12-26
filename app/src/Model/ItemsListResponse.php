<?php

namespace App\Model;

class ItemsListResponse
{
    /**
     * @var ItemsListItem[]
     */
    private array $items;

    /**
     * @param ItemsListItem[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return ItemsListItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
