<?php 
namespace App\Services;

use App\Models\LocationModel;
use App\Models\SettingsModel;

class LocationService
{
    private $locationModel;
    private $settingsModel;

    public function __construct(LocationModel $locationModel, SettingsModel $settingsModel)
    {
        $this->locationModel = $locationModel;
        $this->settingsModel = $settingsModel;
    }

    public function getAllLocationsWithApiKey()
    {
        $locations = $this->locationModel->getMyLocation();
        $googleApiKey = $this->settingsModel->getMySettingsData()->google_api_key;

        return compact('locations', 'googleApiKey');
    }

    public function validateAndStoreOrUpdateLocation($request)
    {
        $validator = $request->validate([
            'name' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'marker_color' => 'required|size:7|regex:/^#[a-fA-F0-9]{6}$/',
        ], [
            'name.required' => 'Konum adı zorunludur.',
            'latitude.required' => 'Enlem zorunludur.',
            'longitude.required' => 'Boylam zorunludur.',
            'marker_color.required' => 'Marker rengi zorunludur.',
            'latitude.numeric' => 'Enlem numerik bir değer olmalıdır.',
            'longitude.numeric' => 'Boylam numerik bir değer olmalıdır.',
            'marker_color.size' => 'Marker rengi 6 karakter olmalıdır.',
        ]);

        $data = [
            'id' => $request->input('id') ?? null,
            'name' => $request->input('name'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'marker_color' => substr($request->input('marker_color'), 1),
        ];

        $this->locationModel->createOrUpdateLocation($data);
    }

    public function getLocationById($id)
    {
        $location = $this->locationModel->getMyLocationById($id);

        return compact('location');
    }

    public function getLocationWithApiKeyById($id)
    {
        $location = $this->locationModel->getMyLocationById($id);
        $googleApiKey = $this->settingsModel->getMySettingsData()->google_api_key;

        return compact('location', 'googleApiKey');
    }

    public function validateSelectedLocations($request)
    {
        $selectedLocations = $request->input('selectedLocations');

        if ($selectedLocations == null || count($selectedLocations) != 2) {
            return redirect()->route('location.create')->with('error', 'Lütfen 2 konum seçiniz.');
        }
    }

    public function getLocationsWithApiKeyByIds($request)
    {
        $selectedLocations = $request->input('selectedLocations');
        $locations = $this->locationModel->getMyLocationByIds($selectedLocations);
        $googleApiKey = $this->settingsModel->getMySettingsData()->google_api_key;

        return compact('locations', 'googleApiKey');
    }

    public function deleteLocationById($id)
    {
        $this->locationModel->deleteMyLocationById($id);
    }
}