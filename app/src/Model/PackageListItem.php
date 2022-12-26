<?php

namespace App\Model;

class PackageListItem
{
    private int $id;
    private string $title;
//    private int $quantity;
//    private string $itemTitle;

    public function __construct(int $id, string $title)
    {
        $this->id = $id;
        $this->title = $title;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
