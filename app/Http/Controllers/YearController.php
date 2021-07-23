<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Year;

class YearController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $year = Year::all();
        return ['year' => $year];
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $year = Year::findOrFail($request->id_year);
        $year->condicion = '0';
        $year->save();
    }
}
