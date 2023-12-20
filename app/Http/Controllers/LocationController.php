<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LocationModel;

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
}