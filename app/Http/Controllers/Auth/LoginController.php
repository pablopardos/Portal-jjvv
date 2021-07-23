<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm(){
        return view('auth.login');
    }

    public function login(Request $request){
        $this->validateLogin($request);

        if(Auth::attempt(['rut' => $request->rut,'password' => $request->password])){
            return redirect()->route('main');
        }
        return back()
        ->withErrors(['rut' => trans('auth.failed')])
        ->withInput(request(['rut']));
    }
    protected function validateLogin(Request $request){
        $this->validate($request,[
            'rut' => 'required|string',
            'password' => 'required|string'
        ]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request ->session()->invalidate();
        return redirect('/');
    }
}
