<?php

namespace App\Http\Controllers;

use App\Http\Resources\DeviceTypeResource;
use App\Http\Resources\ManufacturerResource;
use App\Models\Device;
use App\Models\DeviceMeta;
use App\Models\DeviceType;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Device/Index', [
            'devices' => Device::with(['device_meta' => function($q) {
                $q->with('device_type');
                $q->with('manufacturer');
            }])->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create(Request $request)
    {
        return Inertia::render('Device/Form',
        [
            'method' => 'create',
        ]
    );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        /*$device = Device::create($request->validate([
        ]));
        return redirect()->back()->with('responseData', $device);*/
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
    public function edit()
    {
        return Inertia::render('Device/Form',
            [
                'method' => 'edit',
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Device $device)
    {
        $device->update(request()->validate([
            'serial' => 'required',
            'mac' => 'required'
        ]));
        return redirect()->route('device.index');
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
