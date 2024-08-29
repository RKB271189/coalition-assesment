<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;
    public $fillable = [
        'name'
    ];

    public function tasks()
    {
        $this->hasMany(Tasks::class);
    }
}
