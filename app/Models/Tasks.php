<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;
    public $fillable = [
        'project_id',
        'name',
        'priority',
        'status'
    ];

    public function projects()
    {
        return $this->belongsTo(Projects::class);
    }
}
