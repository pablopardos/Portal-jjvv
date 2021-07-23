<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    protected $table = 'year';
    protected $primaryKey = 'id_year';
    protected $fillable = ['condicion'];
    public $timestamps = false;

    public function certresidencia(){
        return $this->hasMany('App\Certresidencia');
    }
}
