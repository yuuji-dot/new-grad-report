<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table ='users';

    protected $fillable = 
    [
        'number',
        'name',
        'password',
        'role',
        'authority',
        'del_flg',
    ];
    protected $dates = ['deleted_at'];
}
