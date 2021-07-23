<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipopublicacion;

class TipopublicacionController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $tipopublicacion = Tipopublicacion::all();
        return ['tipopublicacion' => $tipopublicacion];
    }
}
