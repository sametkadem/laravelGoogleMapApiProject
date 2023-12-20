<?php

namespace App\Http\Controllers;

use GeneralControllerImportTrait;
use DB;

use Illuminate\Http\Request;


use App\Libraries\ColumnClassificationLibrary;
use Event;
use DateTime;
use Carbon\Carbon;



class GeneralController extends Controller
{   

    public function getToken(){
        return response()->json([
            'token' => 'AIzaSyBlqkmnL0eQb0ZJIeoFW1NFqTa9AMoabEA'
        ]);
    }

}