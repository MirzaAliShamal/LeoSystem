<?php

namespace App\Console\Commands;

use App\Http\Controllers\Logger;
use Illuminate\Console\Command;
use ZipArchive;
use File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class U0C0 extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'u0c0';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    
    /**
     * Execute the console command.
     *
     * @return int
     */
    
    // protected $logger;
     
    // public function __construct()
    // {
    //     $this->logger = new Logger('update.log');
    // }

    public function handle()
    {
       
        return $response;
    }
}
