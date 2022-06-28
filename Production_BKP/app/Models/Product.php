<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable=[

        'name','gender','hobbies','email','password',
    ];

    public function setHobbiesAttribute($products)
    {
        $this->attributes['hobbies'] = json_encode($products);
    }

    public function getHobbiesAttribute($products)
    {
        return $this->attributes['category'] = json_decode($products);
    }

    public function product()
    {
        return $this->belongTo(User::class,'email');
    }
}
