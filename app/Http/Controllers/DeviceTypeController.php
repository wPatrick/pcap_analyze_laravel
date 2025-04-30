<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\DeviceType;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DeviceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('DeviceType/Index',
        [
            'deviceTypes' => DeviceType::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create(Request $request)
    {
        return Inertia::render('DeviceType/Form',
        [
            'method' => 'create',
            'redirect' => $request->input('redirect', null)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $deviceType = DeviceType::create($request->validate([
            'name' => 'required|unique:device_types',
        ]));
        return redirect()->route("deviceType.index");
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
    public function edit(DeviceType $deviceType)
    {
        return Inertia::render('DeviceType/Form',
            [
                'method' => 'edit',
                'deviceType' => $deviceType
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, DeviceType $deviceType)
    {
        $deviceType->update($request->validate([
            'name' => 'required|unique:device_types',
        ]));
        return redirect()->route("deviceType.index");
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
