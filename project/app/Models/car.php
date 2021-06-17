<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class car extends Model
{
    use HasFactory;
    protected $fillable=['carMake', 'carModel', 'PhoneNumber', 'price', 'user_id', 'documents', 'description', 'carArea', 'photo', 'ifRented', 'status']; 
    public function user()
    {
        return $this->belongsTo(User::class);
    }      
    public function search()
    {
        return $this->morphToMany(search::class, 'taggable');
    }   
    public function comment()
    {
        return $this->hasMany(comment::class);
    }      
}
