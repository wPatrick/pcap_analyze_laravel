<?php
namespace App\Services\Menu\Concerns;

use App\Services\Menu\MenuItem;

trait MakesItem
{
    protected function makeItem(string $title): MenuItem
    {
        return new MenuItem($title);
    }
}
