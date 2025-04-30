<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProcessRequest;
use App\Http\Resources\PcapResource;
use App\Models\Customer;
use App\Models\Device;
use App\Models\DeviceMeta;
use App\Models\Pcap;
use App\Models\Process;
use App\Models\ProcessDevice;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class ProcessController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Inertia::render('Process/Index',
            [
                'filters' => \Illuminate\Support\Facades\Request::all('search'),
                'process' => Process::orderBy('id', 'desc')
                    // ->filter(Request::only('search', 'role', 'trashed'))
                    ->paginate(10)
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // restore from session

        return Inertia::render('Process/Create',
            [
                'customers' => Customer::filter(Request::get('customers'))->get(),
                'deviceMetas' => DeviceMeta::filter(Request::get('devices'))->with('devices')->get(),
                'process' => session('process_wizard') ?: null
            ]
        );
    }

    public function visit($route) {
        $allowed_routes = [
            'customer.create',
            'deviceMeta.create'
        ];

        Validator::make(request()->input('name'), [
            'name' => [
                'required',
                Rule::in($allowed_routes),
            ],
        ]);

        session()->put('process_wizard', request()->input('process'));
        return redirect()->route(request()->input('name'));
    }


    public function store(ProcessRequest $request)
    {
        $validated = $request->safe()->except('devices', 'device_meta_id');

        $validated['name'] = 'Irgendwas';
        $validated['obl_id'] = DeviceMeta::find($request->input('device_meta_id'))->obl_id;
        $devices = $request->input('devices');

        $process = Process::create($validated);

        foreach($devices as $device) {
            $device = Device::find($device['id']);
            $device->update([
                'mac' => $device['mac'],
                'serial' => $device['serial'],
            ]);
            $process->devices()->attach($device, ['obl_ext' => $device->oblExt]);
        }

        return redirect()->route('process.index')->with('success', 'Vorgang erstellt');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function pcaps(Process $process)
    {
        return Inertia::render('Process/Pcap/Show',
            [
                'devices' => ProcessDevice::where('process_id', $process->id)->get(),
                'pcaps' => PcapResource::collection(Pcap::where('process_id', $process->id)->get()),
                'process' => $process,
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function devices(Process $process)
    {
        return Inertia::render('Process/Devices/Show',
        [
            'devices' => ProcessDevice::where('process_id', $process->id)->orderBy('id', 'desc')->get(),
            'process' => $process,
            'searchDevices' => Device::where('name', 'like', '%'.Request::get('search').'%')->get()
        ]);
    }

    public function devicesStore(Process $process) {
        $process->devices()->create(Request::all());
        return redirect()->back();
    }

    public function devicesUpdate(Process $process) {
        $device = $process->devices()->find(Request::get('id'))->update(Request::all());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Process $process)
    {
        $settings = $process->settings_comparisons;
        $devices = [] ;
        foreach($process->devices()->with("ips")->get() as $device) {
            foreach($device->ips as $ip) {
                $devices[] = $ip->ip;
            }
        }



        /*$ip_ids = $ips->pluck('id');
        $tcps = Tcp::whereIn('ip_id', $ip_ids)->with("ip")->get();
        $tcp_ids = $tcps->pluck('id');
        $https = Http::whereIn('tcp_id', $tcp_ids)->with("tcp",
            function($query) {
                $query->with("ip");
            })->get();
        $tls = Tls::whereIn('tcp_id', $tcp_ids)->with("tcp",
            function($query) {
                $query->with("ip");
            })->get();
        $udps = Udp::whereIn('ip_id', $ip_ids)->with("ip")->get();
        $udp_ids = $udps->pluck('id');
        $dns = Dns::whereIn('udp_id', $udp_ids)->with("udp",
            function($query) {
                $query->with("ip");
            })->get();
        */
        /*$test = $process->ips()->with("tcps", function($query) {
            $query->with('tls');
            $query->with('https');
        })->get()->flatten();*/


        return Inertia::render('Process/Show',
        [
            'pcaps' => PcapResource::collection(Pcap::where('process_id', $process->id)->get()),
            'process' => $process,
            'ips' => $known_ips,
            'unknownIps' => $unknown_ips
            //'tcps' => $tcps,
            //'udps' => $udps,
            //'tls' => $tls,
            //'https' => $https,
            //'dns' => $dns,
            //'test' => $test
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    public function pcapUpload(Request $request, Process $process)
    {
        $file = Request::file("file");
        $pcap = Pcap::create([
            'process_id' => $process->id,
            'name' => $file->getClientOriginalName()
        ]);
        $pcap->addMedia($file)->toMediaCollection('pcap');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return @return Response
     */
    public function destroy($id)
    {
        //
    }
}
