<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rolfamiliar extends Model
{
    protected $table = 'rolfamiliar';
    protected $primaryKey = 'id_rolfam';
    protected $fillable = ['descrip'];
    public $timestamps = false;

    public function socio(){
        return $this->hasMany('App\Socio');
    }
}
