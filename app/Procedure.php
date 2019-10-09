<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    protected $table = 'procedures';
    protected $fillable = ['id','id_post','name_post','id_main_procedure','name_main_procedure'];
}
