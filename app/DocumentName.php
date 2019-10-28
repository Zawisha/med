<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentName extends Model
{
    protected $table = 'documents_name';
    protected $fillable = ['id','document_name','id_document'];
}
