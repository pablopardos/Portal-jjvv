<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware'=>['guest']],function(){
    Route::get('/', 'Auth\LoginController@showLoginForm')->name('l');
    Route::post('/login', 'Auth\LoginController@login')->name('login');
    Route::post('/estadopago/registrar', 'EstadopagoController@store');//TODOS
    Route::get('/direccion', 'DireccionController@index');//TODOS

    Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
});

Route::group(['middleware'=>['auth']],function(){
    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

    Route::group(['middleware'=>['Socio']],function(){
        Route::get('/userlogin', 'UserController@consultarUsuario');//SOCIO
        Route::get('/sociologin', 'UserController@consultarSocio');//SOCIO
        Route::put('/user/actualizar', 'UserController@update');//SOCIO
        Route::put('/user/acsolicitud', 'UserController@activarSolicitud');//SOCIO
        Route::get('/publicacion', 'PublicacionController@index');//SOCIO
        Route::post('/certresidencia/registrar', 'CertresidenciaController@store');//SOCIO
        Route::get('/estadopago/consulta', 'EstadopagoController@estadosPago');//SOCIO
        Route::put('/estadopago/acestado', 'EstadopagoController@activarEstado');//SOCIO
        Route::put('/estadopago/desestado', 'EstadopagoController@desactivarEstado');//SOCIO
        Route::get('/tipopublicacion', 'TipopublicacionController@index');//SOCIO
        Route::get('/ecivil', 'EcivilController@index');//SOCIO
        Route::get('/rolfamiliar', 'RolfamiliarController@index');//SOCIO

        Route::post('/estadopago/registrar', 'EstadopagoController@store');//TODOS
        Route::get('/direccion', 'DireccionController@index');//TODOS

    });

    Route::group(['middleware'=>['Administrador']],function(){
        Route::put('/user/desolicitud', 'UserController@desactivarSolicitud');//ADMIN
        Route::get('/socio', 'SocioController@index');//ADMIN
        Route::post('/socio/registrar', 'SocioController@store');//ADMIN
        Route::put('/socio/actualizar', 'SocioController@update');//ADMIN
        Route::put('/socio/eliminar', 'SocioController@destroy');//ADMIN
        Route::post('/publicacion/registrar', 'PublicacionController@store');//ADMIN
        Route::put('/publicacion/actualizar', 'PublicacionController@update');//ADMIN
        Route::put('/publicacion/eliminar', 'PublicacionController@destroy');//ADMIN
        Route::get('/certresidencia', 'CertresidenciaController@index');//ADMIN
        Route::put('/certresidencia/eliminar', 'CertresidenciaController@destroy');//ADMIN
        Route::get('/estadopago', 'EstadopagoController@index');//ADMIN;
        Route::put('/estadopago/actualizar', 'EstadopagoController@update');//ADMIN
        Route::get('/nuevosocio', 'NuevosocioController@index');//ADMIN
        Route::put('/nuevosocio/eliminar', 'NuevosocioController@destroy');//ADMIN
        Route::post('/nuevosocio/registrar', 'NuevosocioController@store');//ADMIN
        Route::get('/year', 'YearController@index');//ADMIN
        Route::put('/year/desactivar', 'YearController@desactivar');//ADMIN

        Route::get('/userlogin', 'UserController@consultarUsuario');//SOCIO
        Route::get('/sociologin', 'UserController@consultarSocio');//SOCIO
        Route::put('/user/actualizar', 'UserController@update');//SOCIO
        Route::put('/user/acsolicitud', 'UserController@activarSolicitud');//SOCIO
        Route::get('/publicacion', 'PublicacionController@index');//SOCIO
        Route::post('/certresidencia/registrar', 'CertresidenciaController@store');//SOCIO
        Route::get('/estadopago/consulta', 'EstadopagoController@estadosPago');//SOCIO
        Route::put('/estadopago/acestado', 'EstadopagoController@activarEstado');//SOCIO
        Route::put('/estadopago/desestado', 'EstadopagoController@desactivarEstado');//SOCIO
        Route::get('/tipopublicacion', 'TipopublicacionController@index');//SOCIO
        Route::get('/ecivil', 'EcivilController@index');//SOCIO
        Route::get('/rolfamiliar', 'RolfamiliarController@index');//SOCIO

        Route::post('/estadopago/registrar', 'EstadopagoController@store');//TODOS
        Route::get('/direccion', 'DireccionController@index');//TODOS

    });

});

Route::get('/home', 'HomeController@index')->name('home');
