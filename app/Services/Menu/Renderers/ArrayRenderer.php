<?php

namespace App\Services\Menu\Renderers;

use App\Services\Menu\Contracts\Renderer;
use App\Services\Menu\Menu;
use App\Services\Menu\MenuItem;

class ArrayRenderer implements Renderer
{
    public function render(Menu $menu)
    {
        return ['items' => array_map([$this, 'renderMenuItem'], $this->sort($menu->items))];
    }

    protected function renderMenuItem(MenuItem $menuItem): array
    {
        return [
            'title' => $menuItem->title,
            'path' => $menuItem->path,
            'is_active' => $menuItem->isActive,
            'target' => $menuItem->target,
            'icon' => $menuItem->icon,
            'children' => array_map([$this, 'renderMenuItem'], $this->sort($menuItem->children))
        ];
    }

    protected function sort(array $items): array
    {
        uasort($items, function (MenuItem $a, MenuItem $b) {
            return (($a->order ?? PHP_INT_MAX) >= ($b->order ?? PHP_INT_MAX)) ? 1 : -1;
        });
        return array_values($items);
    }
}
