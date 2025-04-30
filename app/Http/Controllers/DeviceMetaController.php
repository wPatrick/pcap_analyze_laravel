<?php

namespace App\Http\Controllers;

use App\Http\Resources\DeviceTypeResource;
use App\Http\Resources\ManufacturerResource;
use App\Models\DeviceMeta;
use App\Models\DeviceType;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DeviceMetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('DeviceMeta/Index', [
            'devices' => DeviceMeta::with('manufacturer')->with('device_type')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create(Request $request)
    {
        return Inertia::render('DeviceMeta/Form',
            [
                'method' => 'create',
                'wizardRedirect' => route('deviceMeta.create'),
                'deviceTypes' => DeviceTypeResource::collection(DeviceType::filter(\Illuminate\Support\Facades\Request::get('deviceTypes'))->get()),
                'manufacturers' => ManufacturerResource::collection(Manufacturer::filter(\Illuminate\Support\Facades\Request::get('manufacturers'))->get())
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
        $deviceMeta = DeviceMeta::create($request->validate([
            'manufacturer_id' => 'required|exists:manufacturers,id',
            'device_type_id' => 'required|exists:device_types,id',
            'name' => 'required',
            'obl_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
            'date_of_receipt' => 'nullable|date',
            'date_of_issue' => 'nullable|date',
            'typ' => 'required',
            'misc' => 'nullable',
        ]));

        for($i=1; $i <= $deviceMeta->quantity; $i++) {
            $deviceMeta->devices()->create([
                'number' => $i
            ]);
        }

        $deviceMeta = DeviceMeta::find($deviceMeta->id)->with("devices");
        return redirect()->back()->with('responseData', $deviceMeta);
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
    public function edit(DeviceMeta $deviceMetum)
    {
        return Inertia::render('DeviceMeta/Form',
            [
                'method' => 'edit',
                'deviceMeta' => $deviceMetum,
                'deviceType' => $deviceMetum->device_type,
                'manufacturer' => $deviceMetum->manufacturer,
                'deviceTypes' => DeviceTypeResource::collection(DeviceType::filter(\Illuminate\Support\Facades\Request::get('deviceTypes'))->get()),
                'manufacturers' => ManufacturerResource::collection(Manufacturer::filter(\Illuminate\Support\Facades\Request::get('manufacturers'))->get())
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeviceMeta $deviceMetum)
    {
        $quantity = $deviceMetum->quantity;
        $deviceMetum->update($request->validate([
            'manufacturer_id' => 'required|exists:manufacturers,id',
            'device_type_id' => 'required|exists:device_types,id',
            'name' => 'required',
            'obl_id' => 'required|integer',
            'quantity' => 'required|integer|min:'.$deviceMetum->quantity,
            'date_of_receipt' => 'nullable|date',
            'date_of_issue' => 'nullable|date',
            'typ' => 'required',
            'misc' => 'nullable',
        ]));

        for($i=$quantity+1; $i <= $deviceMetum->quantity; $i++) {
            $deviceMetum->devices()->create([
                'number' => $i
            ]);
        }

        return redirect()->back()->with('responseData', $deviceMetum);
    }

    /**ad
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
