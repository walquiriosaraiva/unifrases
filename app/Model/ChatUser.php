<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ChatUser extends Model
{
    protected $table = 'chat_users';

    protected $fillable = [
        'nickname'
    ];

}
