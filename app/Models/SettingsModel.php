<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Libraries\ColumnClassificationLibrary;
use Event;


class SettingsModel extends Model
{   
    public function getMySettingsData(){
        $data = DB::table('settings')->first();
        return $data;
    }

    public function updateSettings($id , $api_key){
        $data = [
            'google_api_key' => $api_key
        ];
        $control = DB::table('settings')->where('id', $id)->exists($data);

        if($control){
            $update = DB::table('settings')->where('id', $id)->update($data);
        }
        else{
            $update = DB::table('settings')->insert($data);
        }
        return $update;
    }


}
