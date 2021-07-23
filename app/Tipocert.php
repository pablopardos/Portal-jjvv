<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipocert extends Model
{
    protected $table = 'tipocert';
    protected $primaryKey = 'id_tipocert';
    protected $fillable = ['tipo'];
    public $timestamps = false;

    public function certresidencia(){
        return $this->hasMany('App\Certresidencia');
    }
}
