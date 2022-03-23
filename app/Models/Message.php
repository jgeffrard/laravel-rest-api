<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'message_id';

    protected $table = 'messages';

    protected $fillable = ['sender_user_id', 'message', 'date', 'receiver_user_id'];
}