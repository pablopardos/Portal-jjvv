<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Socio extends Model
{
    protected $table = 'socio';
    protected $primaryKey = 'id_socio';
    protected $fillable = [
        'id_direc',
        'id_ecivil',
        'id_rolfam',
        'num_socio',
        'nom_p',
        'nom_s',
        'ap_p',
        'ap_s',
        'prof',
        'email',
        'telefono',
        'edad'
    ];

    public $timestamps = false;

    public function users(){
        return $this->hasOne('App\Users');
    }

    public function certresidencia(){
        return $this->hasMany('App\Certresidencia');
    }

    public function direccion(){
        return $this->belongsTo('App\Direccion');
    }

    public function ecivil(){
        return $this->belongsTo('App\Ecivil');
    }

    public function rolfamiliar(){
        return $this->belongsTo('App\Rolfamiliar');
    }
}
