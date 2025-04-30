<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class InventoryController extends Controller
{
    public function index()
    {
        return Inertia::render('Inventory/Index',
            [
            'filters' => Request::all('search'),
            'inventory' => Inventory::orderBy('id', 'desc')
                ->filter(Request::only('search', 'trashed'))
                // ->filter(Request::only('search', 'role', 'trashed'))
                ->paginate(10)
                ->through(fn ($inventory) => [
                    'id' => $inventory->id,
                    'typ' => $inventory->typ,
                    'eingangsdatum' => $inventory->wareneingangsdatum,
                    'seriennummer' => $inventory->seriennummer,
                    'manufacturer' => $inventory->manufacturer ? $inventory->manufacturer->name : null,
                    'created_at' => $inventory->created_at->format('d.m.Y H:m'),
                    'deleted_at' => $inventory->deleted_at,
                ]),
        ]
        );
    }

}
