<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nuevosocio;

class NuevosocioController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $nuevosocio = Nuevosocio::join('direccion','nuevosocio.id_direc','=','direccion.id_direc')
        ->join('calle','direccion.id_calle','=','calle.id_calle')
        ->join('numero','direccion.id_num','=','numero.id_num')
        ->select(
            'nuevosocio.id_nuevo',
            'nuevosocio.id_direc',
            'nuevosocio.rut',
            'nuevosocio.password',
            'nuevosocio.nom_p',
            'nuevosocio.nom_s',
            'nuevosocio.ap_p',
            'nuevosocio.ap_s',
            'nuevosocio.prof',
            'nuevosocio.email',
            'nuevosocio.telefono',
            'nuevosocio.edad',
            'calle.calle as ns_calle',
            'numero.num as ns_numero',
            )
        ->orderby('nuevosocio.id_nuevo', 'desc')->get();

        return ['nuevosocio' => $nuevosocio];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $nuevosocio = new Nuevosocio();
        $nuevosocio->id_direc = $request->id_direc;
        $nuevosocio->rut = $request->rut;
        $nuevosocio->password = $request->password;
        $nuevosocio->nom_p = $request->nom_p;
        $nuevosocio->nom_s = $request->nom_s;
        $nuevosocio->ap_p = $request->ap_p;
        $nuevosocio->ap_s = $request->ap_s;
        $nuevosocio->prof = $request->prof;
        $nuevosocio->email = $request->email;
        $nuevosocio->telefono = $request->telefono;
        $nuevosocio->edad = $request->edad;
        $nuevosocio->save();
    }

    public function destroy(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $nuevosocio = Nuevosocio::destroy($request->id_nuevo);
    }

}
