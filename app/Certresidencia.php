<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certresidencia extends Model
{
    protected $table = 'certresidencia';
    protected $primaryKey = 'id_cert';
    protected $fillable = [
        'id_tipocert',
        "id_socio",
        'rut',
        'nombre',
        'asunto'
    ];
    public $timestamps = false;

    public function tipocert(){
        return $this->belongsTo('App\Tipocert');
    }

    public function socio(){
        return $this->belongsTo('App\Socio');
    }
}
