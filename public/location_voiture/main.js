// Récupérer le statut de l'utilisateur (visiteur, utilisateur connecté, administrateur)
// Vous devrez définir cette variable en fonction de l'état actuel de l'utilisateur dans votre application.
const userType = "utilisateur"; // "visiteur", "utilisateur", "administrateur"

// Exécuter le code suivant une fois que le DOM est chargé
document.addEventListener("DOMContentLoaded", function () {
    // Sélectionner le menu
    const menu = document.querySelector("nav ul");

    // Effacer le menu actuel
    menu.innerHTML = "";

    // Créer le menu en fonction du type d'utilisateur
    switch (userType) {
        case "visiteur":
            createVisitorMenu();
            break;
        case "utilisateur":
            createUserMenu();
            break;
        case "administrateur":
            createAdminMenu();
            break;
        default:
            console.error("Type d'utilisateur non reconnu");
    }
    
});

// Fonction pour créer le menu visiteur
function createVisitorMenu() {
    menu.innerHTML = `
        <li><a href="index.html">Accueil</a></li>
        <li><a href="cars.html">Liste des véhicules</a></li>
        <li><a href="about.html">À propos</a></li>
        <li><a href="register.html">Inscription</a></li>
        <li><a href="login.html">Connexion</a></li>
    `;
}

// Fonction pour créer le menu utilisateur connecté
function createUserMenu() {
    menu.innerHTML = `
        <li><a href="index.html">Accueil</a></li>
        <li><a href="cars.html">Liste des véhicules</a></li>
        <li><a href="rental-history.html">Mes Locations</a></li>
        <li><a href="profile.html">Mon Compte</a></li>
        <li><a href="#" onclick="logout()">Déconnexion</a></li>
    `;
}

// Fonction pour créer le menu administrateur connecté
function createAdminMenu() {
    menu.innerHTML = `
        <li><a href="index.html">Accueil</a></li>
        <li><a href="cars.html">Liste des véhicules</a></li>
        <li><a href="users.html">Utilisateurs</a></li>
        <li><a href="rentals.html">Locations</a></li>
        <li><a href="profile.html">Mon Compte</a></li>
        <li><a href="#" onclick="logout()">Déconnexion</a></li>
    `;
}

// Fonction de déconnexion (à implémenter selon votre logique)
function logout() {
    // Ajoutez le code de déconnexion ici
}


function louer() {
    switch (userType) {
        case "visiteur":
            // Rediriger le visiteur vers la page de connexion
            window.location.href = "login.html";
            break;
        case "utilisateur":
        case "administrateur":
            // Rediriger l'utilisateur ou l'administrateur vers la page de locations
            window.location.href = "car-details.html";
            break;
        default:
            console.error("Type d'utilisateur non reconnu");
    }
}


// gestion des uilisateur

// Générer des données d'utilisateurs pour simulation
const userData = [
    { name: "John Doe", email: "john@example.com", phone: "123-456-7890" },
    { name: "Jane Smith", email: "jane@example.com", phone: "987-654-3210" },
    // Ajoutez autant d'utilisateurs que nécessaire
];

// Sélectionner le tableau des utilisateurs
const userTableBody = document.querySelector("#user-table tbody");

// Remplir le tableau avec les données d'utilisateurs
userData.forEach(user => {
    const row = userTableBody.insertRow();
    row.insertCell(0).textContent = user.name;
    row.insertCell(1).textContent = user.email;
    row.insertCell(2).textContent = user.phone;
    row.insertCell(3).innerHTML = '<button onclick="editUser(this)">Modifier</button> <button onclick="deleteUser(this)">Supprimer</button>';
});


function showAddUserForm() {
const addUserForm = document.getElementById("add-user-form");
addUserForm.style.display = "block";
}

function addUser() {
// Ajouter la logique pour ajouter un nouvel utilisateur
// Vous pouvez récupérer les valeurs du formulaire et les ajouter à la liste d'utilisateurs simulée
const newUserName = document.getElementById("newUserName").value;
const newUserEmail = document.getElementById("newUserEmail").value;
const newUserPhone = document.getElementById("newUserPhone").value;
const newUserPassword = document.getElementById("newUserPassword").value;

// Ajoutez le nouvel utilisateur à la liste simulée
const userTableBody = document.querySelector("#user-table tbody");
const row = userTableBody.insertRow();
row.insertCell(0).textContent = newUserName;
row.insertCell(1).textContent = newUserEmail;
row.insertCell(2).textContent = newUserPhone;
row.insertCell(3).innerHTML = '<button onclick="editUser(this)">Modifier</button> <button onclick="deleteUser(this)">Supprimer</button>';

// Réinitialise le formulaire
resetAddUserForm();
}

function resetAddUserForm() {
document.getElementById("newUserName").value = "";
document.getElementById("newUserEmail").value = "";
document.getElementById("newUserPhone").value = "";
document.getElementById("newUserPassword").value = "";

// Masque le formulaire
const addUserForm = document.getElementById("add-user-form");
addUserForm.style.display = "none";
}

function editUser(button) {
// Ajouter la logique pour éditer un utilisateur
// Vous pouvez récupérer les données de la ligne du tableau et les utiliser pour remplir le formulaire d'édition
// À implémenter selon votre logique
alert("Fonctionnalité d'édition à implémenter");
}

function deleteUser(button) {
// Ajouter la logique pour supprimer un utilisateur
// Vous pouvez supprimer la ligne du tableau correspondante
const row = button.parentNode.parentNode;
const userTableBody = document.querySelector("#user-table tbody");
userTableBody.removeChild(row);
alert("Utilisateur supprimé");
}

// mes locations
// Exemple de données (vous devrez remplacer ceci par des données réelles)
const rentalData = [
    { date: '2024-01-01', model: 'Toyota Camry', duration: '3 jours', cost: '$150.00' },
    // Ajoutez d'autres données selon vos besoins
];



