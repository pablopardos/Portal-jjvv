<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estadopago;

class EstadopagoController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $estadopago = Estadopago::join('direccion','estadopago.id_direc','=','direccion.id_direc')
            ->join('year','estadopago.id_year','=','year.id_year')
            ->join('calle','direccion.id_calle','=','calle.id_calle')
            ->join('numero','direccion.id_num','=','numero.id_num')
            ->select(
                'estadopago.id_estpag',
                'estadopago.id_direc',
                'estadopago.id_year',
                'estadopago.ene',
                'estadopago.feb',
                'estadopago.mar',
                'estadopago.abr',
                'estadopago.may',
                'estadopago.jun',
                'estadopago.jul',
                'estadopago.ago',
                'estadopago.sep',
                'estadopago.oct',
                'estadopago.nov',
                'estadopago.dic',
                'direccion.id_direc as direccion',
                'calle.calle as calle',
                'numero.num as numero')
            ->orderby('estadopago.id_estpag', 'asc')->paginate(10);
        }
        else{
            $estadopago = Estadopago::join('direccion','estadopago.id_direc','=','direccion.id_direc')
            ->join('year','estadopago.id_year','=','year.id_year')
            ->join('calle','direccion.id_calle','=','calle.id_calle')
            ->join('numero','direccion.id_num','=','numero.id_num')
            ->select(
                'estadopago.id_estpag',
                'estadopago.id_direc',
                'estadopago.id_year',
                'estadopago.ene',
                'estadopago.feb',
                'estadopago.mar',
                'estadopago.abr',
                'estadopago.may',
                'estadopago.jun',
                'estadopago.jul',
                'estadopago.ago',
                'estadopago.sep',
                'estadopago.oct',
                'estadopago.nov',
                'estadopago.dic',
                'direccion.id_direc as direccion',
                'calle.calle as calle',
                'numero.num as numero')
            ->where('estadopago.'.$criterio, 'like', '%'. $buscar. '%')
            ->orderby('estadopago.id_estpag', 'asc')->paginate(10);
        }

        return [
            'pagination' => [
                'total'         => $estadopago->total(),
                'current_page'  => $estadopago->currentPage(),
                'per_page'      => $estadopago->perPage(),
                'last_page'     => $estadopago->lastPage(),
                'from'          => $estadopago->firstItem(),
                'to'            => $estadopago->lastItem(),
            ],
            'estadopago' => $estadopago
        ];
    }

    public function estadosPago()
    {
        //if (!$request->ajax()) return redirect('/');
        $estadopago = Estadopago::all();
        return $estadopago;
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $estadopago = new Estadopago();
        $estadopago->id_direc = $request->id_direc;
        $estadopago->id_year = $request->id_year;
        $estadopago->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $estadopago = Estadopago::findOrFail($request->id_estpag);
        $estadopago->ene = $request->ene;
        $estadopago->feb = $request->feb;
        $estadopago->mar = $request->mar;
        $estadopago->abr = $request->abr;
        $estadopago->may = $request->may;
        $estadopago->jun = $request->jun;
        $estadopago->jul = $request->jul;
        $estadopago->ago = $request->ago;
        $estadopago->sep = $request->sep;
        $estadopago->oct = $request->oct;
        $estadopago->nov = $request->nov;
        $estadopago->dic = $request->dic;
        $estadopago->save();
    }

    public function activarEstado(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $estadopago = Estadopago::findOrFail($request->id_estpag);
        $estadopago->estadopago = '1';
        $estadopago->save();
    }

    public function desactivarEstado(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $estadopago = Estadopago::findOrFail($request->id_estpag);
        $estadopago->estadopago = '0';
        $estadopago->save();
    }
}
