<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $table = 'chat_messages';

    protected $fillable = [
        'from_nickname','to_nickname','message','status'
    ];

}
