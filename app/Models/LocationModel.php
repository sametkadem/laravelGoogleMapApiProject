<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Libraries\ColumnClassificationLibrary;
use Event;


class LocationModel extends Model
{   
    

    public function createLocation($data){

       $exists = DB::table('location')
            ->where('name', $data['name'])->exists();
        if($exists){
            $update = DB::table('location')->where('name', $data['name'])->update($data);
            return $update;
        }
        else{
            $insert = DB::table('location')->insert($data);
            return $insert;
        }
    }

    public function getMyLocation(){
        $data = DB::table('location')->get();
        return $data;
    }


}
