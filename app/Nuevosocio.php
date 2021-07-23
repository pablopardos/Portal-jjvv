<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nuevosocio extends Model
{
    protected $table = 'nuevosocio';
    protected $primaryKey = 'id_nuevo';
    protected $fillable = [
        'id_direc',
        'rut',
        'password',
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
}
