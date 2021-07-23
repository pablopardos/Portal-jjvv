<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    //use Notifiable;
    protected $primaryKey = 'id_user';
    public $timestamps = false;

    protected $fillable = [
        'id_user', 'id_socio', 'id_perm', 'rut', 'password', 'solicitud'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];
    public function publicacion(){
        return $this->hasMany('App\Publicacion');
    }
    public function socio(){
        return $this->belongsTo('App\Socio');
    }
    public function permiso(){
        return $this->belongsTo('App\Permiso');
    }
}
