<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'user_id';

    protected $table = 'users';

    protected $fillable = ['email', 'first_name', 'last_name', 'password'];
}