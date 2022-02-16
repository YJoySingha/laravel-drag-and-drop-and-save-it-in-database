<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taskpriority extends Model
{
    use HasFactory;

    protected $table = 'task_priority';

    protected $primaryKey = 'id';

    protected $fillable = [
        'tp_name','tp_desc','tp_category',
    ];
}
