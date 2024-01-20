<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'end_date',
        'start_date',
        'car_id',
        'user_id',
        'status',
        'prix',
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation with le car
    /*public function car()
    {
        return $this->belongsToMany (Car::class);
    }*/

protected static function booted()
{
    static::creating(function ($location) {
        // Vérifier si la date de début est dans le futur
         if ($location->start_date <= now() && $location->end_date >= now()) {
            // La location est en cours
            $location->status = 'en cours';
        } else {
            // La location n'a pas encore commencé, le statut reste inchangé (peut être 'confirmé')
        }
    });

    static::updating(function ($location) {
        // Vérifier si la date de fin est modifiée
        if ($location->isDirty('end_date') && $location->end_date <= now()) {
            // Mettre à jour le statut en 'terminé' à la fin de la location
            $location->status = 'terminé';
        } elseif ($location->start_date <= now() && $location->end_date >= now()) {
            // La location est en cours
            $location->status = 'en cours';
        } else {
            // La location n'a pas encore commencé, le statut reste inchangé (peut être 'confirmé')
        }
    });
}


public function car()
{
    return $this->belongsTo(Car::class, 'car_id');
}

}
