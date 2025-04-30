<?php

namespace App\Console\Commands;

use App\Models\Manufacturer;
use Illuminate\Console\Command;

class importManufacturers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:manufacturer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $csv = array_map(function($item) {
            return str_getcsv($item, ";");
        } , file(storage_path('dumps/manufacturer.csv')));
        foreach($csv as $index => $item) {
            if($index === 0) continue; // skip first line
            Manufacturer::create(
                [
                    'id' => $item[0],
                    'name' => $item[1]
                ]
            );
        }


        return 1;
    }
}
