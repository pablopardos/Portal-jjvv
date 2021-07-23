<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Direccion;

class DireccionController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $direccion = Direccion::join('calle','direccion.id_calle','=','calle.id_calle')
        ->join('numero','direccion.id_num','=','numero.id_num')
        ->select('direccion.id_direc','numero.num as num_direc','calle.calle as calle_direc')
        ->orderby('direccion.id_direc', 'asc')->get();

        return ['direccion' => $direccion];
    }
}
