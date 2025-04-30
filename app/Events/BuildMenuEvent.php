<?php

namespace App\Events;
use App\Services\Menu\Menu;

class BuildMenuEvent
{
    public Menu $menu;

    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }
}
