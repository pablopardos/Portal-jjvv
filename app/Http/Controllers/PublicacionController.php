<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Publicacion;

class PublicacionController extends Controller
{
   
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $publicacion = Publicacion::join('tipopublicacion','publicacion.id_tipopub','=','tipopublicacion.id_tipopub')
            ->select('publicacion.id_pub','publicacion.id_tipopub','publicacion.asunto','publicacion.descrip','tipopublicacion.tipo as tipo')
            ->orderby('publicacion.id_pub', 'desc')->paginate(10);
        }
        else{
            $publicacion = Publicacion::join('tipopublicacion','publicacion.id_tipopub','=','tipopublicacion.id_tipopub')
            ->select('publicacion.id_pub','publicacion.id_tipopub','publicacion.asunto','publicacion.descrip','tipopublicacion.tipo as tipo')
            ->where('publicacion.'.$criterio, 'like', '%'. $buscar. '%')
            ->orderby('publicacion.id_pub', 'desc')->paginate(10);
        }

        

        return [
            'pagination' => [
                'total'         => $publicacion->total(),
                'current_page'  => $publicacion->currentPage(),
                'per_page'      => $publicacion->perPage(),
                'last_page'     => $publicacion->lastPage(),
                'from'          => $publicacion->firstItem(),
                'to'            => $publicacion->lastItem(),
            ],
            'publicacion' => $publicacion
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $publicacion = new Publicacion();
        $publicacion->id_tipopub = $request->id_tipopub;
        $publicacion->id_user = \Auth::user()->id_user;
        $publicacion->asunto = $request->asunto;
        $publicacion->descrip = $request->descrip;
        $publicacion->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $publicacion = Publicacion::findOrFail($request->id_pub);
        $publicacion->id_tipopub = $request->id_tipopub;
        $publicacion->id_user = \Auth::user()->id_user;
        $publicacion->asunto = $request->asunto;
        $publicacion->descrip = $request->descrip;
        $publicacion->save();
    }

    public function destroy(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $publicacion = Publicacion::destroy($request->id_pub);
    }
}
