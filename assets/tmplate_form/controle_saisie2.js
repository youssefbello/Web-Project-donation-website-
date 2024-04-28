
function validerNom() {
    var nomObjet = document.getElementById("nom");
    var nomObjetError = document.getElementById("nom-error");
    var regex = /^[a-zA-Z\s]+$/; // Ajout de \s pour inclure les espaces

    if (regex.test(nomObjet.value) || nomObjet.value.trim().length === 0) {
        nomObjetError.innerHTML = ""; // Efface le message d'erreur
        nomObjet.style.border = "none"; // Supprime la bordure de l'élément d'erreur
        nomObjet.style.borderColor = "green"; // Réinitialise la couleur de la bordure du champ d'entrée
    } else {
        nomObjetError.innerHTML = "Le nom doit contenir uniquement des lettres"; // Met à jour le message d'erreur
        nomObjet.style.border = "1.5px solid red"; // Ajoute une bordure rouge au champ d'entrée
        nomObjet.style.borderColor = "red"; // Définit la couleur de la bordure du champ d'entrée en rouge
    }
}


function validerprenom() {
    var nomObjet = document.getElementById("prenom");
    var nomObjetError = document.getElementById("prenom-error");
    var regex = /^[a-zA-Z]+$/;
    if (regex.test(nomObjet.value) || nomObjet.value.length == 0) {
        nomObjetError.innerHTML = ""; // Clear the error message
        nomObjet.style.border = "none"; // Remove the border from the error element
        nomObjet.style.borderColor = "green"; // Reset the border color of the input field
    } else {
        nomObjetError.innerHTML = "Prenom  doit contenir uniquement des lettres"; // Update the error message
        nomObjet.style.border = "1.5px solid red"; // Add a red border to the input field
        nomObjet.style.borderColor = "red"; // Set the border color of the input field to red
    }
}
function validerTel() {
    var telObjet = document.getElementById("tel");
    var telObjetError = document.getElementById("tel-error");
    var regex = /^\+?([2][0-9]|[5][0-9]|[9][0-9])[0-9]{7,12}$/;

    // Supprimer les espaces en début et en fin
    var telValue = telObjet.value.trim();

    // Vérifier si le numéro contient des caractères non autorisés
    var caractereNonAutorise = /[^0-9+]/;

    if (telValue.length === 0) {
        // Le champ est vide, considéré comme valide
        telObjetError.innerHTML = "";
        telObjet.style.border = "none";
        telObjet.style.borderColor = "green";
    } else if (telValue.length == 8 && !caractereNonAutorise.test(telValue) && regex.test(telValue)) {
        // Le numéro de téléphone est valide
        telObjetError.innerHTML = "";
        telObjet.style.border = "none";
        telObjet.style.borderColor = "green";
    } else if (telValue.length > 8) {
        // Le numéro de téléphone n'est pas valide
        telObjetError.innerHTML = "Le numéro de téléphone doit être valide et ne pas contenir '*'";
        telObjet.style.border = "1.5px solid red";
        telObjet.style.borderColor = "red";
    }
}


// Validation du champ "Prix min" (entier)
/*function validerMontant() {
    var prixInitial = document.getElementById("montant");
    var prixInitialError = document.getElementById("montant-error");
    var pricePattern = /^(?!(?:0|0\.0|0\.00)$)[+]?\d+(\.\d|\.\d[0-9])?$/;

    if (pricePattern.test(prixInitial.value) || prixInitial.value.length == 0) {
        prixInitialError.innerHTML = "";
        prixInitial.style.border = "none";
        prixInitial.style.borderColor = "green";
    } else {
        prixInitialError.innerHTML = "montant est obligatoire et doit être un nombre entier";
        prixInitial.style.border = "1.5px solid red";
        prixInitial.style.borderColor = "red";
    }
}*/
function validernom() {
    var nomObjet = document.getElementById("email");
    var nomObjetError = document.getElementById("email-error");
    var regex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
    if (regex.test(nomObjet.value) || nomObjet.value.length == 0) {
        nomObjetError.innerHTML = ""; // Clear the error message
        nomObjet.style.border = "none"; // Remove the border from the error element
        nomObjet.style.borderColor = "green"; // Reset the border color of the input field
    } else {
        nomObjetError.innerHTML = "Email doit etre valide"; // Update the error message
        nomObjet.style.border = "1.5px solid red"; // Add a red border to the input field
        nomObjet.style.borderColor = "red"; // Set the border color of the input field to red
    }
}




document.addEventListener('DOMContentLoaded', function () {
    function setDefaultDateTime() {
        // Get the current date and time in the local time zone
        var currentDate = new Date();
        var localDate = new Date(currentDate.getTime() - currentDate.getTimezoneOffset() * 60000);

        // Format the date to 'YYYY-MM-DDTHH:mm' (the format expected by input type=datetime-local)
        var formattedDate = localDate.toISOString().slice(0, 16);

        // Set the formatted date and time as the default value for the datetime-local input field
        var dateInput = document.getElementById('date');
        dateInput.value = formattedDate;
    }

    // Set the default date and time when the page is loaded
    setDefaultDateTime();
});
document.addEventListener("DOMContentLoaded", function () {
    const formu = document.querySelector('form');
    formu.addEventListener("input", function (e) {
        e.preventDefault();
        validerNom();
        validerprenom();
        validerTel();
        validerMontant();

    });
});