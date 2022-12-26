<?php

namespace App\Tests\Builder\Entity;

use App\Entity\Items;

class ItemsBuilder
{
    private string $itemName;

    public function __construct($title = 'item 1')
    {
        $this->itemName = $title;
    }

    public function build(): Items
    {
        return (new Items())->setItemName($this->itemName);
    }

}
