<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rolfamiliar;

class RolfamiliarController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $rolfamiliar = Rolfamiliar::all();
        return ['rolfamiliar' => $rolfamiliar];
    }
}
