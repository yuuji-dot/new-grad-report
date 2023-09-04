<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table ='tasks';

    protected $fillable = 
    [
        'user_id',
        'task',
        'del_flg'
    ];
    protected $dates = ['deleted_at'];
}
