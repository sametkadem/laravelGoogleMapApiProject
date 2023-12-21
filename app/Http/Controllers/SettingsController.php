<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SettingsModel;

class SettingsController extends Controller
{
    private $settingsModel;

    public function __construct(SettingsModel $settingsModel)
    {
        $this->settingsModel = $settingsModel;
    }

    public function showForm()
    {
        try {
            $settingsData = $this->settingsModel->getMySettingsData() ?? (object)['id' => 0, 'google_api_key' => ''];
            return view('settings', compact('settingsData'));
        } catch (\Exception $e) {
            return redirect()->route('settings')->with('error', 'Bir hata oluştu: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $api_key = $request->input('api_key');
            $update = $this->settingsModel->updateSettings($id, $api_key);
            return redirect()->route('settings')->with('success', 'Veri güncellendi!');
        } catch (\Exception $e) {
            return redirect()->route('settings')->with('error', 'Bir hata oluştu: ' . $e->getMessage());
        }
    }

    public function getMyGoogleApiKey()
    {
        try {
            $settingsData = $this->settingsModel->getMySettingsData();
            return $settingsData->google_api_key;
        } catch (\Exception $e) {
            return null;
        }
    }
}