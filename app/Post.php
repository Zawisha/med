<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['id','id_post','id_procedure','id_block','block_name', 'question_text','answer_id','answer_text','answer_link_id'];
}
