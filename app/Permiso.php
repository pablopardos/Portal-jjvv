<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    protected $table = 'permiso';
    protected $primaryKey = 'id_perm';
    protected $fillable = ['tipo','descrip'];
    public $timestamps = false;

    public function user(){
        return $this->hasMany('App\User');
    }

}
