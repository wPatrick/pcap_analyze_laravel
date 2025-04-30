<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


class PcapImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pcap:import {pcapfile : file path of the pcap json file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import pcap json file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        $pcapfile = $this->argument('pcapfile');
        $file = file_get_contents($pcapfile);
        PcapAnalyze::analyze($file);
        return 0;
    }
}
