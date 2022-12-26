<?php

namespace App\Model;

class ItemsListItem
{
    private int $id;
    private string $itemName;

    public function __construct(int $id, string $itemName)
    {
        $this->id = $id;
        $this->itemName = $itemName;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getItemName(): string
    {
        return $this->itemName;
    }
}
