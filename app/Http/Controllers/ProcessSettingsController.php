<?php

namespace App\Http\Controllers;

use App\Models\Process;
use App\Models\ProcessDevice;
use Request;
use Inertia\Inertia;

class ProcessSettingsController extends Controller
{
    public function show(Process $process)
    {
        $comparisons = $process->settings_comparisons()->with("device_a")->with("device_b")->get();

        return Inertia::render('Process/Settings',
            [
                'devices' => $process->devices,
                'process' => $process,
                'compareDevices' => $comparisons
            ]);
    }

    public function store(Process $process) {
        Request::validate([
            'deviceA' => 'required',
            'deviceB' => 'required'
        ]);


        $process->settings_comparisons()->create(
            [
                'device_a' => Request::get('deviceA')['id'],
                'device_b' => Request::get('deviceB')['id'],
            ]
        );

        return redirect()->back();
    }


}
