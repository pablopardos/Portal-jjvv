<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipopublicacion extends Model
{
    protected $table = 'tipopublicacion';
    protected $primaryKey = 'id_tipopub';
    protected $fillable = ['tipo'];
    public $timestamps = false;

    public function publicacion(){
        return $this->hasMany('App\Publicacion');
    }
}
