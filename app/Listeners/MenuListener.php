<?php

namespace App\Listeners;

use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Events\BuildMenuEvent;

class MenuListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param BuildMenuEvent $event
     * @return void
     */
    public function handle(BuildMenuEvent $event)
    {
        $menu = $event->menu;

        $menu->item("Vorgänge")
            ->path(route('process.index'))
            ->active(request()->routeIs('process.*'))
            ->icon('FolderIcon');

        $menu->item("Mittschnitte")
            ->path(route('pcaps'))
            ->active(request()->routeIs('pcaps.*'))
            ->icon('OfficeBuildingIcon');

        $menu->item("Ressourcen")
            ->icon('UsersIcon')
            ->child('Geräte Meta')
            ->path(route('deviceMeta.index'))
            ->active(request()->routeIs('deviceMeta.*'));

        $menu->item("Ressourcen")
            ->child('Gerätetypen')
            ->path(route('deviceType.index'))
            ->active(request()->routeIs('deviceType.*'));

        $menu->item("Ressourcen")
            ->child('Kunden')
            ->path(route('customer.index'))
            ->active(request()->routeIs('customer.*'));

        $menu->item("Ressourcen")
            ->child('Hersteller')
            ->path(route('manufacturer.index'))
            ->active(request()->routeIs('manufacturer.*'));


    }
}
