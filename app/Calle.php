<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calle extends Model
{
    protected $table = 'calle';
    protected $primaryKey = 'id_calle';
    protected $fillable = ['calle'];
    public $timestamps = false;
}
