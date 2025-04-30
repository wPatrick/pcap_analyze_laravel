<?php

namespace App\Services\Menu\Contracts;

use App\Services\Menu\Menu;

interface Renderer
{
    public function render(Menu $menu);
}
