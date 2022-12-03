<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrentClass extends Model
{
    use HasFactory;
    protected $fillable = [
        'current_class'
    ];

    // public function students()
    // {

    //     $this->hasMany(Student::class);
    // }
}
