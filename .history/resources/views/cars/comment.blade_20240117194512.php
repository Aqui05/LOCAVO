<!-- Dans votre vue -->
<form action="{{ route('cars.comment', ['car' => $car->id]) }}" method="post">
    @csrf
    <div class="form-group">
        <label for="comment">Commentaire :</label>
        <textarea name="comment" id="comment" class="form-control" rows="3" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Ajouter un commentaire</button>
</form>
