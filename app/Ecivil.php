<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ecivil extends Model
{
    protected $table = 'ecivil';
    protected $primaryKey = 'id_ecivil';
    protected $fillable = ['descrip'];
    public $timestamps = false;

    public function socio(){
        return $this->hasMany('App\Socio');
    }
}
