<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task_status extends Model
{
    protected $table ='task_statuses';

    protected $fillable = 
    [
        'user_id',
        'task_id',
        'progress',
        'comment',
        'good',
        'del_flg'
    ];
    protected $dates = ['deleted_at'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function task(){
        return $this->belongsTo(Task::class, 'task_id');
    }
}
