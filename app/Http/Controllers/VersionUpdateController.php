<?php

namespace App\Http\Controllers;

use App\Traits\General;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use File;
use ZipArchive;

class VersionUpdateController extends Controller
{
    use General;
    protected $logger;
    public function __construct()
    {
        $this->logger = new Logger(storage_path('logs/update.log'));
    }

    public function versionUpdate(Request $request)
    {
        $data['title'] = __('Version Update');
       
        return view('install.installer.version-update', $data);
    }

    public function processUpdate(Request $request)
    {
       

        return redirect()->route('main.index');
    }

    public function versionFileUpdate(Request $request)
    {
        


        // return view('admin.version_update.create', $data);
    }
    
    
    public function versionFileUpdateStore(Request $request)
    {
       $request->validate([
            'update_file' => 'bail|required|mimes:zip'
       ]);

        set_time_limit(1200);
        $path = storage_path('app/source-code.zip');

        if (file_exists($path)) {
            File::delete($path);
        }
        
        try{
            $request->update_file->storeAs('/','source-code.zip');
        }
        catch(\Exception $e){
            return response()->json(
                $e->getMessage(), 
                500
              );
        }
    }

    public function executeUpdate(){
       
        return true;
    }
    
    public function versionUpdateExecute(){
        $response = $this->executeUpdate();
        if($response['success'] == true){
            return back();
        }
        else{
            // $this->logger->log('sfsdfsdfdsfsdf', $response['message']);
            $this->showToastrMessage('error', json_encode($response['message']));
        }
        return back();
    }
   
    public function versionFileUpdateDelete(){
        $path = storage_path('app/source-code.zip');

        if (file_exists($path)) {
            File::delete($path);
        }
    }
}
