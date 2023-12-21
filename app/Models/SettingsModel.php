<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingsModel extends Model
{
    protected $table = 'settings';
    protected $fillable = ['google_api_key'];

    public function getMySettingsData()
    {
        return $this->first();
    }

    public function updateSettings($id, $api_key)
    {
        $data = ['google_api_key' => $api_key];

        $existingRecord = $this->find($id);

        if ($existingRecord) {
            $existingRecord->update($data);
        } else {
            $this->create($data);
        }

        return true; 
    }
}
