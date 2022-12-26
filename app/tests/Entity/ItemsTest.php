<?php

namespace App\Tests\Entity;

use App\Tests\Builder\Entity\ItemsBuilder;
use PHPUnit\Framework\TestCase;

class ItemsTest extends TestCase
{
    public function testSuccess(): void
    {
        $item = (new ItemsBuilder($title = 'item1'))->build();

        $this->assertEquals($title, $item->getItemName());
    }

}
