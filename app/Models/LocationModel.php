<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationModel extends Model
{   

    protected $table = 'location';
    protected $fillable = ['name', 'latitude', 'longitude', 'marker_color'];

    public function createOrUpdateLocation($data)
    {
        return $this->updateOrCreate(
            ['id' => $data['id']],
            [
                'name' => $data['name'],
                'latitude' => $data['latitude'],
                'longitude' => $data['longitude'],
                'marker_color' => substr($data['marker_color'], 1),
            ]
        );
    }

    public function getMyLocation()
    {
        return $this->all();
    }

    public function getMyLocationById($id)
    {
        return $this->find($id);
    }

    public function getMyLocationByIds($ids)
    {
        return $this->whereIn('id', $ids)->get();
    }

    public function updateMyLocationById($data)
    {
        return $this->where('id', $data['id'])->update([
            'name' => $data['name'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'marker_color' => substr($data['marker_color'], 1),
        ]);
    }

    public function deleteMyLocationById($id)
    {
        return $this->destroy($id);
    }

}
