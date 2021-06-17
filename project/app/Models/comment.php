<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;
    protected $fillable=['user_id','comment','car_id']; 

    public function car()
    {
        return $this->belongsTo(car::class);
    }  
    public function user()
    {
        return $this->belongsTo(user::class);
    }  

}
