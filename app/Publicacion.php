<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    protected $table = 'publicacion';
    protected $primaryKey = 'id_pub';
    protected $fillable = [
        'id_tipopub',
        "id_user",
        'asunto',
        'descrip'
    ];
    public $timestamps = false;

    public function tipoPublicacion(){
        return $this->belongsTo('App\Tipopublicacion');
    }

    public function users(){
        return $this->belongsTo('App\Users');
    }
}
