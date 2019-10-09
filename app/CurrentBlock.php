<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrentBlock extends Model
{
    protected $table = 'current_block';
    protected $fillable = ['id','id_post','id_procedure', 'id_block'];
}
