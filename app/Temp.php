<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temp extends Model
{
    protected $table = 'temp';
    protected $fillable = ['id','id_post','name_post','parent','text', 'number_line'];


}
