<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessPcaps;
use App\Models\Pcap;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PcapController extends Controller
{

    public function analyze(Pcap $pcap) {
        $pcap->update(['analyzed' => false]);
        $processPcap = new ProcessPcaps($pcap);
        $this->dispatch($processPcap);
        return redirect()->back();
    }

    public function download(Pcap $pcap) {
        $headers = [
            'Content-Disposition' => 'attachment; filename="'. $pcap->name .'"',
        ];
        $file = $pcap->media('pcap')->first()->getTemporaryUrl(Carbon::now()->addMinutes(5));
        return redirect($file);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function show(Pcap $pcap) {
        return Inertia::render('Pcap/Show', [
            'pcap' => $pcap
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Pcap $pcap)
    {
        $pcap->delete();
        return redirect()->back();
    }
}
