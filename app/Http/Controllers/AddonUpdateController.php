<?php

namespace App\Http\Controllers;

use App\Traits\ApiStatusTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use File;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use ZipArchive;

class AddonUpdateController extends Controller
{
    use ApiStatusTrait;
    protected $logger;
    public function __construct()
    {
        $this->logger = new Logger(storage_path('logs/addon.log'));
    }

    

    public function addonSaasFileStore(Request $request)
    {
        $request->validate([
            'update_file' => 'bail|required|mimes:zip'
        ]);
        set_time_limit(1200);
        $path = storage_path('app/addons/' . $request->code . '.zip');

        if (file_exists($path)) {
            File::delete($path);
        }

        try {
            $request->update_file->storeAs('addons/', $request->code . '.zip');
        } catch (Exception $e) {
            return $this->error([], $e->getMessage());
        }
    }

    public function addonSaasFileExecute(Request $request)
    {
        if($request->licenseStatus == 1){
            $request->validate([
                'email' => 'required',
                'purchase_code' => 'required'
            ]);
        }

        $purchase_code = $request->purchase_code;
        $code = $request->code;
        try {
            $returnResponse = $this->addonSaasFileExecuteUpdate($code, $purchase_code, $request->email, $request->fullUrl());
            if ($returnResponse['success'] == true) {
                Auth::logout();
                return $this->success([], __('Addon Installed Successfully'));;
            }
            return $this->error([], json_encode($returnResponse['message']));
        } catch (Exception $e) {
            return $this->error([], $e->getMessage());
        }
    }

    public function addonSaasFileExecuteUpdate($code, $purchase_code, $email, $fullUrl)
    {
      
        return true;
    }

    public function addonSaasFileDelete($code)
    {
        $path = storage_path('app/addons/' . $code . '.zip');

        if (file_exists($path)) {
            File::delete($path);
        }
    }
}
