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


        public function isAvailable()
    {
        // Vous devez définir la logique appropriée pour déterminer si la voiture est disponible
        // Par exemple, si vous avez une colonne 'disponible' dans votre base de données :
        return $this->disponible;
    }
}
