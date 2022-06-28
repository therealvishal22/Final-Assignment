<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable=[

        'name','active',
    ];

    public function category()
    {
        return $this->belongTo(Category::class,'name');
    }
}
