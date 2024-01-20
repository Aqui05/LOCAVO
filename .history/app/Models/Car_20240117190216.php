<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'marque',
        'model',
        'matriculation',
        'description',
        'prix',
        'photo_path',
        'category',
        'rating'
    ];


        public function locations()
    {
        return $this->hasMany(Location::class);
    }

        public function isAvailable()
    {
            return $this->locations()->where(function ($query) {
            $query->where('end_date', '>', now())
                ->orWhereNull('end_date');
        })->count() === 0;
    }

    // Car.php
public function ratings()
{
    return $this->hasMany(Rating::class);
}

}
