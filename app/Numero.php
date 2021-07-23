<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Numero extends Model
{
    protected $table = 'numero';
    protected $primaryKey = 'id_num';
    protected $fillable = ['num'];
    public $timestamps = false;
}
