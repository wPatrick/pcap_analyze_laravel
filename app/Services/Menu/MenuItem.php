<?php

namespace App\Services\Menu;

class MenuItem
{
    use Concerns\Order,
        Concerns\MakesItem;

    const TARGET_BLANK = '_blank';
    public string $title;
    public ?string $path = null;
    public ?string $icon = null;
    public bool $isActive = false;
    public int $order;
    public ?string $target = null;
    public array $children = [];
    private ?MenuItem $parent = null;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function icon(?string $icon): self
    {
        $this->icon = $icon;
        return $this;
    }

    public function path(?string $path): self
    {
        $this->path = $path;
        return $this;
    }

    public function active(bool $isActive): self
    {
        $this->isActive = $isActive;
        if($this->parent !== null)
            $this->parent->isActive =  $this->parent->isActive || $isActive;
        return $this;
    }

    public function order(int $order): self
    {
        $this->order = $order;
        return $this;
    }

    public function target(?string $target): self
    {
        $this->target = $target;
        return $this;
    }

    public function child(string $title): MenuItem
    {
        if (isset($this->children[$title])) {
            return $this->children[$title];
        }
        $menuItem = $this->makeItem($title);
        $menuItem->order($this->nextOrder($this->children));
        $menuItem->parent = &$this;
        $this->children[$title] = $menuItem;
        return $menuItem;
    }
}
