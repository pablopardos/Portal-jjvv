<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Socio;
use App\User;


class SocioController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $socio = User::join('socio','socio.id_socio','=','users.id_socio')
            ->join('direccion','socio.id_direc','=','direccion.id_direc')
            ->join('calle','direccion.id_calle','=','calle.id_calle')
            ->join('numero','direccion.id_num','=','numero.id_num')
            ->join('ecivil','socio.id_ecivil','=','ecivil.id_ecivil')
            ->join('rolfamiliar','socio.id_rolfam','=','rolfamiliar.id_rolfam')
            ->select(
                'socio.id_socio',
                'socio.id_direc',
                'socio.id_ecivil',
                'socio.id_rolfam',
                'socio.num_socio',
                'socio.nom_p',
                'socio.nom_s',
                'socio.ap_p',
                'socio.ap_s',
                'socio.prof',
                'socio.email',
                'socio.telefono',
                'socio.edad',
                'users.id_user',
                'users.rut',
                'users.password',
                'direccion.id_direc as s_direccion',
                'calle.calle as s_calle',
                'numero.num as s_numero',
                'ecivil.descrip as ecivil',
                'rolfamiliar.descrip as rolfam')
            ->orderby('socio.num_socio', 'asc')->paginate(8);
        }
        else{
            $socio = User::join('socio','socio.id_socio','=','users.id_socio')
            ->join('direccion','socio.id_direc','=','direccion.id_direc')
            ->join('calle','direccion.id_calle','=','calle.id_calle')
            ->join('numero','direccion.id_num','=','numero.id_num')
            ->join('ecivil','socio.id_ecivil','=','ecivil.id_ecivil')
            ->join('rolfamiliar','socio.id_rolfam','=','rolfamiliar.id_rolfam')
            ->select(
                'socio.id_socio',
                'socio.id_direc',
                'socio.id_ecivil',
                'socio.id_rolfam',
                'socio.num_socio',
                'socio.nom_p',
                'socio.nom_s',
                'socio.ap_p',
                'socio.ap_s',
                'socio.prof',
                'socio.email',
                'socio.telefono',
                'socio.edad',
                'users.id_user',
                'users.rut',
                'users.password',
                'direccion.id_direc as s_direccion',
                'calle.calle as s_calle',
                'numero.num as s_numero',
                'ecivil.descrip as ecivil',
                'rolfamiliar.descrip as rolfam')
            ->where('socio.'.$criterio, 'like', '%'. $buscar. '%')
            ->orderby('socio.num_socio', 'asc')->paginate(8);
        }

        return [
            'pagination' => [
                'total'         => $socio->total(),
                'current_page'  => $socio->currentPage(),
                'per_page'      => $socio->perPage(),
                'last_page'     => $socio->lastPage(),
                'from'          => $socio->firstItem(),
                'to'            => $socio->lastItem(),
            ],
            'socio' => $socio
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try {
            DB::beginTransaction();
            
            $socio = new Socio();
            $socio->id_direc = $request->id_direc;
            $socio->id_ecivil = '1';
            $socio->id_rolfam = '1';
            $socio->num_socio = $request->num_socio;
            $socio->nom_p = $request->nom_p;
            $socio->nom_s = $request->nom_s;
            $socio->ap_p = $request->ap_p;
            $socio->ap_s = $request->ap_s;
            $socio->prof = $request->prof;
            $socio->email = $request->email;
            $socio->telefono = $request->telefono;
            $socio->edad = $request->edad;
            $socio->save();

            $user = new User();
            $user->id_perm = '1';
            $user->id_socio = $socio->id_socio;
            $user->rut = $request->rut;
            $user->password =  bcrypt($request->password);
            $user->save();

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try {
            DB::beginTransaction();

            $user = User::findOrFail($request->id_user);
            
            $socio = Socio::findOrFail($user->id_socio);

            $socio->id_direc = $request->id_direc;
            $socio->id_ecivil = $request->id_ecivil;
            $socio->id_rolfam = $request->id_rolfam;
            $socio->num_socio = $request->num_socio;
            $socio->nom_p = $request->nom_p;
            $socio->nom_s = $request->nom_s;
            $socio->ap_p = $request->ap_p;
            $socio->ap_s = $request->ap_s;
            $socio->prof = $request->prof;
            $socio->email = $request->email;
            $socio->telefono = $request->telefono;
            $socio->edad = $request->edad;
            $socio->save();

            $user->rut = $request->rut;
            $user->password = bcrypt($request->password);
            $user->save();

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function destroy(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $socio = Socio::destroy($request->id_socio);
    }
}
