<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estadopago extends Model
{
    protected $table = 'estadopago';
    protected $primaryKey = 'id_estpag';
    protected $fillable = [
        'id_direc',
        "id_year",
        'ene',
        'feb',
        'mar',
        'abr',
        'may',
        'jun',
        'jul',
        'ago',
        'sep',
        'oct',
        'nov',
        'dic',
        'estadopago'
    ];
    public $timestamps = false;

    public function year(){
        return $this->belongsTo('App\Year');
    }

    public function direccion(){
        return $this->belongsTo('App\Direccion');
    }
}
