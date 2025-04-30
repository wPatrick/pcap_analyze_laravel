<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $manufacturers = Manufacturer::paginate(10)->onEachSide(1);
        return Inertia::render('Manufacturer/Index', [
            'manufacturers' => $manufacturers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create(Request $request)
    {
        return Inertia::render('Manufacturer/Form', [
            'method' => 'create',
            'redirect' => $request->input('redirect', null),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|RedirectResponse
     */
    public function store()
    {
        Manufacturer::create(request()->validate([
            'name' => 'required|unique:manufacturers',
        ]));
        return redirect()->route("manufacturer.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function edit(Manufacturer $manufacturer)
    {
        return Inertia::render('Manufacturer/Form', [
            'method' => 'edit',
            'manufacturer' => $manufacturer
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Manufacturer $manufacturer
     * @return RedirectResponse
     */
    public function update(Manufacturer $manufacturer)
    {
        $manufacturer->update(request()->validate([
            'name' => 'required|unique:manufacturers',
        ]));
        return redirect()->route("manufacturer.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
