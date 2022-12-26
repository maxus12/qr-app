<?php

namespace App\Model;

use App\Entity\PlaceAction;

class PlaceActionList
{
    /**
     * @var PlaceAction[]
     */
    private array $items;

    /**
     * @param PlaceAction[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return PlaceAction[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
