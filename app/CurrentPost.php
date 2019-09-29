<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrentPost extends Model
{
    protected $table = 'current_post';
    protected $fillable = ['id','id_post','name_post'];
}
