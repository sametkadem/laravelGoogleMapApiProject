<?php

namespace App\Http\Controllers;

use GeneralControllerImportTrait;
use DB;

use Illuminate\Http\Request;


use App\Libraries\ColumnClassificationLibrary;
use Event;
use DateTime;
use Carbon\Carbon;

use App\Models\SettingsModel;


class SettingsController extends Controller
{   
    public function showForm()
    {
        $settingsModel = new SettingsModel();
        $settingsData = ['settingsData' => $settingsModel->getMySettingsData()];
        $dataArray = json_decode(json_encode($settingsData), true);
        if($dataArray['settingsData'] == null){
           $settingsData = ['settingsData' => (object) ['id' => 0, 'google_api_key' => '']];
        }
        return view('settings', $settingsData);
    }

    public function update(Request $request, $id)
    {
        $settingsModel = new SettingsModel();
        $api_key = $request->input('api_key');
        $update = $settingsModel->updateSettings($id, $api_key);
        return redirect()->route('settings')->with('success', 'Veri güncellendi!');
    }

    public function getMyGoogleApiKey(){
        $settingsModel = new SettingsModel();
        $settingsData = $settingsModel->getMySettingsData();
        return $settingsData->google_api_key;
    }
    

}