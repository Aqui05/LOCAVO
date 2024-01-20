// Fonction pour calculer le prix de la location
function calculateRentalPrice() {
    // Récupérer la durée de la location et la date de début depuis les champs du formulaire
    const rentalDuration = parseInt(document.getElementById("rental-duration").value);
    const startDate = new Date(document.getElementById("start-date").value);

    // Effectuer des calculs pour estimer le prix (vous devrez remplacer cela par votre logique de tarification)
    const dailyRate = 10000; // Tarif quotidien (exemple)
    const estimatedPrice = rentalDuration * dailyRate;

    // Afficher le coût estimé sur la page
    document.getElementById("estimated-price").textContent = `Coût estimé : ${estimatedPrice} FCFA`;
}

// Fonction pour confirmer la location
function confirmRental() {
    // Ajoutez ici la logique pour confirmer la location, par exemple, rediriger vers la page de paiement
    // Remplacez l'URL par le chemin correct de votre fichier payment.html
    window.location.href = "payment.html";
}





