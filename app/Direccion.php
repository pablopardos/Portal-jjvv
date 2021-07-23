<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    protected $table = 'direccion';
    protected $primaryKey = 'id_direc';
    protected $fillable = ['id_calle','id_num',];
    public $timestamps = false;

    public function Socio(){
        return $this->hasMany('App\Socio');
    }

    public function estadopago(){
        return $this->hasMany('App\Estadopago');
    }

    public function Nuevosocio(){
        return $this->hasMany('App\Nuevosocio');
    }

    public function calle(){
        return $this->belongsTo('App\Calle');
    }

    public function numero(){
        return $this->belongsTo('App\Numero');
    }

}
