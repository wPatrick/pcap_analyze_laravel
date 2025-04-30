<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\DeviceIp;
use App\Models\DeviceMeta;
use App\Models\Process;
use App\Models\ProcessDevice;
use Inertia\Inertia;
use Inertia\Response;
use Request;

class ProcessDevicesController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Process $process)
    {
        return Inertia::render('Process/Devices/Show',
            [
                'devices' => $process->devices()->with('device_meta')->get(),
                'process' => $process,
                'searchDevices' => Device::filter(request('search'))
            ]);
    }

    public function store(Process $process) {
        $process->devices()->create(Request::all());
        return redirect()->back();
    }

    public function update(ProcessDevice $device) {
        $device->update(Request::validate([
            'name' => 'required',
        ]));
        return redirect()->back();
    }

    public function addIp(ProcessDevice $device) {
        $device->ips()->create(Request::validate([
            'ip' => 'required|ip'
        ]));
        return redirect()->back();
    }

    public function removeIp(DeviceIp $deviceIp) {
        $deviceIp->delete();
        return redirect()->back();
    }

    public function destroy(ProcessDevice $device)
    {
        // $device->ips()->delete();
        $device->delete();
        return redirect()->back();
    }
}
