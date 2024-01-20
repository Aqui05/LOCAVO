<!-- Form for editing location -->
<form action="{{ route('locations.update', $location->id) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- Fields for editing -->
    <!-- Date de début -->
    <label for="start_date">Date de début:</label>
    <input type="date" name="start_date" value="{{ $location->start_date }}"
        @if ($location->status == 'en cours') disabled @endif>

    <!-- Date de fin -->
    <label for="end_date">Date de fin:</label>
    <input type="date" name="end_date" value="{{ $location->end_date }}"
        @if ($location->status == 'terminé' || $location->status == 'annulé' ) disabled @endif>

    <!-- Autres champs à mettre à jour -->

    <!-- Bouton de soumission -->
    <button type="submit">Mettre à jour la location</button>
</form>
