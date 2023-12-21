<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LocationService;

class LocationController extends Controller
{   

    private $locationService;

    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    public function create()
    {
        return $this->handleErrors(function () {
            $data = $this->locationService->getAllLocationsWithApiKey();

            return view('location', $data);
        });
    }

    public function storeOrUpdate(Request $request)
    {
        return $this->handleErrors(function () use ($request) {
            $this->locationService->validateAndStoreOrUpdateLocation($request);

            return redirect()->route('location.create')->with('success', 'İşlem başarıyla tamamlandı.');
        });
    }

    public function editByID($id)
    {
        return $this->handleErrors(function () use ($id) {
            $data = $this->locationService->getLocationById($id);

            return view('location_edit', $data);
        });
    }

    public function showMapById($id)
    {
        return $this->handleErrors(function () use ($id) {
            $data = $this->locationService->getLocationWithApiKeyById($id);

            return view('location_map', $data);
        });
    }

    public function showDistanceMayByIds(Request $request)
    {
        return $this->handleErrors(function () use ($request) {
            $this->locationService->validateSelectedLocations($request);
            $data = $this->locationService->getLocationsWithApiKeyByIds($request);

            return view('location_distance', $data);
        });
    }

    public function deleteById($id)
    {
        return $this->handleErrors(function () use ($id) {
            $this->locationService->deleteLocationById($id);

            return redirect()->route('location.create')->with('success', 'Konum başarıyla silindi.');
        });
    }

    private function handleErrors($callback)
    {
        try {
            return $callback();
        } catch (\Exception $e) {
            return redirect()->route('location.create')->with('error', 'Bir hata oluştu: ' . $e->getMessage());
        }
    }

}