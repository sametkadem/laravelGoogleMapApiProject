<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LocationModel;
use App\Models\SettingsModel;

class LocationController extends Controller
{
    public function create()
    {
        $locationModel = new LocationModel();
        $locations = $locationModel->getMyLocation();
        $locations = ['locations' => $locations];
        return view('location', $locations);
    }

    public function store(Request $request)
    {
        $locationModel = new LocationModel();
        /*
        $request->validate([
            'name' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'marker_color' => 'required|size:6',
        ], [
            'name.required' => 'Konum adı zorunludur.',
            'latitude.required' => 'Enlem zorunludur.',
            'longitude.required' => 'Boylam zorunludur.',
            'marker_color.required' => 'Marker rengi zorunludur.',
            'latitude.numeric' => 'Enlem numerik bir değer olmalıdır.',
            'longitude.numeric' => 'Boylam numerik bir değer olmalıdır.',
            'marker_color.size' => 'Marker rengi 6 karakter olmalıdır.',
        ]);
        */

        $data = [
            'name' => $request->input('name'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'marker_color' => $request->input('marker_color')
        ];


        $create = $locationModel->createLocation($data);
        return redirect()->route('location.create')->with('success', 'Konum başarıyla eklendi.');
    }

    public function editByID($id)
    {
        $locationModel = new LocationModel();
        $location = $locationModel->getMyLocationById($id);
        $location = ['location' => $location];
        return view('location_edit', $location);
    }

    public function updateById(Request $request){
        $locationModel = new LocationModel();
         /*
        $request->validate([
            'name' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'marker_color' => 'required|size:6',
        ], [
            'name.required' => 'Konum adı zorunludur.',
            'latitude.required' => 'Enlem zorunludur.',
            'longitude.required' => 'Boylam zorunludur.',
            'marker_color.required' => 'Marker rengi zorunludur.',
            'latitude.numeric' => 'Enlem numerik bir değer olmalıdır.',
            'longitude.numeric' => 'Boylam numerik bir değer olmalıdır.',
            'marker_color.size' => 'Marker rengi 6 karakter olmalıdır.',
        ]);
        */
        $data = [
            'id'            => $request->input('id'),
            'name'          => $request->input('name'),
            'latitude'      => $request->input('latitude'),
            'longitude'     => $request->input('longitude'),
            'marker_color'  => substr($request->input('marker_color'),1)
        ];
        $update = $locationModel->updateMyLocationById($data);
        return redirect()->route('location.create')->with('success', 'Konum başarıyla güncellendi.');
    }

    public function showMapById($id){
        $locationModel = new LocationModel();
        $settingsModel = new SettingsModel();

        $location = $locationModel->getMyLocationById($id);
        $location = ['location' => $location, 'google_api_key' => $settingsModel->getMySettingsData()->google_api_key];
        return view('location_map', $location); 
    }
}