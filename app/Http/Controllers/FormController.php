<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function showForm()
    {
        return view('form');
    }

    public function processForm(Request $request)
    {
        $x = $request->input('x');
        $y = $request->input('y');
        $color = $request->input('color');
        return "X: $x, Y: $y, Renk: $color";
    }
}