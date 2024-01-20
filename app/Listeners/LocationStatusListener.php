<?php

namespace App\Listeners;

use App\Events\LocationStatusUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LocationStatusListener implements ShouldQueue
{
    public function handle(LocationStatusUpdated $event)
    {
        $location = $event->location;

        // Mise à jour du statut en fonction du moment de l'événement
        if ($event->location->start_date <= now() && $event->location->end_date >= now()) {
            $location->status = 'en cours';
        } elseif ($event->location->end_date < now()) {
            $location->status = 'terminé';
        }

        $location->save();
    }
}
