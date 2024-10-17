<?php

namespace App\Console\Commands;

use App\Http\Controllers\Logger;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class auxvy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auxvy {--lqs=} {--v=}';

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
    public function handle()
    {
        DB::beginTransaction();
        
            DB::rollBack();
         
        return true;
    }
}
