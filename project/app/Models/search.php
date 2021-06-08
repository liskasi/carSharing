<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class search extends Model
{
    use HasFactory;
    public function Car()
    {
        return $this->morphToMany(Car::class, 'taggable');
    }  
    public function user()
    {
        return $this->belongsTo(user::class);
    }  
}
