<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'description',
        'make',
        'model',
        'colour',
        'year',
        'transmisson',
        'car_type',
        'price',
        'photo',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favouritedBy()
    {
        return $this->belongsToMany(User::class, 'favourites', 'car_id', 'user_id');
    }
}
