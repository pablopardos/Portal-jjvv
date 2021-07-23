<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Socio;
use App\User;


class UserController extends Controller
{
    public function index()
    {
        if (!$request->ajax()) return redirect('/');
        $user = User::all();
        return $user;
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try {
            DB::beginTransaction();

            $user = User::findOrFail($request->id_user);
            
            $socio = Socio::findOrFail($user->id_socio);

            $socio->id_ecivil = $request->id_ecivil;
            $socio->id_rolfam = $request->id_rolfam;
            $socio->prof = $request->prof;
            $socio->email = $request->email;
            $socio->telefono = $request->telefono;
            $socio->save();

            $user->password = bcrypt($request->password);
            $user->save();

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function consultarUsuario()
    {
        //if (!$request->ajax()) return redirect('/');
        $usuarioLogueado = \Auth::user()->id_user;
        $user = User::findOrFail($usuarioLogueado);
        return $user;
    }

    public function consultarSocio()
    {
        //if (!$request->ajax()) return redirect('/');
        $socioLogueado = \Auth::user()->id_socio;
        $socio = Socio::findOrFail($socioLogueado);
        return $socio;
    }

    public function activarSolicitud(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id_user);
        $user->solicitud = '1';
        $user->save();
    }

    public function desactivarSolicitud(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id_socio);
        $user->solicitud = '0';
        $user->save();
    }
}
 