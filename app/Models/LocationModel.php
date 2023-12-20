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

    public function getMyLocationById($id){
        $data = DB::table('location')->where('id', $id)->first();
        return $data;
    }

    public function getMyLocationByIds($ids){
        $data = DB::table('location')->whereIn('id', $ids)->get();
        return $data;
    }

    public function updateMyLocationById($data){
        $data = DB::table('location')
            ->where('id', $data['id'])
            ->update($data);
        return $data;
    }

    public function deleteMyLocationById($id){
        $data = DB::table('location')
            ->where('id', $id)
            ->delete();
        return $data;
    }


}
