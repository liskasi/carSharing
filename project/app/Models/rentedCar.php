<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rentedCar extends Model
{
    use HasFactory;
    protected $fillable=['user_id', 'car_id','rentedStatus']; 
    public function Car()
    {
        return $this->morphToMany(User::class, 'taggable');
    }  
}
