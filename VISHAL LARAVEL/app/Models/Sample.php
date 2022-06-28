<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    use HasFactory;

    protected $fillable=[

        'name','category','image','created_by','active',
    ];

    public $primaryKey = 'id';

    public function product()
    {
        return $this->belongsTo('App\Product','id');
    }

}