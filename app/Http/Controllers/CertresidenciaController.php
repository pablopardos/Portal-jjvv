<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Certresidencia;

class CertresidenciaController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $certresidencia = Certresidencia::join('tipocert','certresidencia.id_tipocert','=','tipocert.id_tipocert')
            ->join('socio','certresidencia.id_socio','=','socio.id_socio')
            ->join('direccion','socio.id_direc','=','direccion.id_direc')
            ->join('estadopago', function ($join) {
                $join->on('direccion.id_direc','=','estadopago.id_direc')
                    ->where('estadopago.id_year', '=', 2021);
            })
            ->join('calle','direccion.id_calle','=','calle.id_calle')
            ->join('numero','direccion.id_num','=','numero.id_num')
            ->select(
                'certresidencia.id_cert',
                'certresidencia.id_tipocert',
                'certresidencia.id_socio',
                'certresidencia.rut',
                'certresidencia.nombre',
                'certresidencia.asunto',
                'socio.id_direc as direccion',
                'socio.telefono as telefono',
                'calle.calle as calle',
                'numero.num as numero',
                'estadopago.estadopago as estado',
                'tipocert.tipo as tipo')
            ->orderby('certresidencia.id_cert', 'asc')->paginate(5);
        }
        else{
            $certresidencia = Certresidencia::join('tipocert','certresidencia.id_tipocert','=','tipocert.id_tipocert')
            ->join('socio','certresidencia.id_socio','=','socio.id_socio')
            ->join('direccion','socio.id_direc','=','direccion.id_direc')
            ->join('calle','direccion.id_calle','=','calle.id_calle')
            ->join('numero','direccion.id_num','=','numero.id_num')
            ->select(
                'certresidencia.id_cert',
                'certresidencia.id_tipocert',
                'certresidencia.id_socio',
                'certresidencia.rut',
                'certresidencia.nombre',
                'certresidencia.asunto',
                'socio.id_direc as direccion',
                'socio.telefono as telefono',
                'calle.calle as calle',
                'numero.num as numero',
                'tipocert.tipo as tipo')
            ->where('certresidencia.'.$criterio, 'like', '%'. $buscar. '%')
            ->orderby('certresidencia.id_cert', 'asc')->paginate(5);
        }

        return [
            'pagination' => [
                'total'         => $certresidencia->total(),
                'current_page'  => $certresidencia->currentPage(),
                'per_page'      => $certresidencia->perPage(),
                'last_page'     => $certresidencia->lastPage(),
                'from'          => $certresidencia->firstItem(),
                'to'            => $certresidencia->lastItem(),
            ],
            'certresidencia' => $certresidencia
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $certresidencia = new Certresidencia();
        $certresidencia->id_tipocert = $request->id_tipocert;
        $certresidencia->id_socio =  \Auth::user()->id_socio;
        $certresidencia->rut = $request->rut;
        $certresidencia->nombre = $request->nombre;
        $certresidencia->asunto = $request->asunto;
        $certresidencia->save();
    }

    public function destroy(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $certresidencia = Certresidencia::destroy($request->id_cert);
    }
}
