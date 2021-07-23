<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ecivil;

class EcivilController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $ecivil = Ecivil::all();
        return ['ecivil' => $ecivil];
    }
}
