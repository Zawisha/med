<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForgetPassword extends Model
{
    protected $table = 'forget_email';

    protected $fillable = [
        'token', 'user_id',
    ];
}
