document.addEventListener("DOMContentLoaded", function () {
    // Code JavaScript pour gérer les interactions de paiement
    const paymentButton = document.getElementById("payment-button");
    paymentButton.addEventListener("click", function () {
        handlePayment();
    });
});

function handlePayment() {
    window.location.href = "rental-history.html";
}
