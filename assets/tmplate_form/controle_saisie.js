// Validation pour le champ "Nom de l'objet"
function validernom() {
    var nomObjet = document.getElementById("nom-objet");
    var nomObjetError = document.getElementById("nom-objet-error");
    var regex = /^[a-zA-Z ]+$/;
    if (regex.test(nomObjet.value)|| nomObjet.value.length==0) {
        nomObjetError.innerHTML = ""; // Clear the error message
        nomObjet.style.border = "none"; // Remove the border from the error element
        nomObjet.style.borderColor = "green"; // Reset the border color of the input field
    } else {
        nomObjetError.innerHTML = "Nom de l'objet doit contenir des lettres alphabetiques et des espaces"; // Update the error message
        nomObjet.style.border = "1.5px solid red"; // Add a red border to the input field
        nomObjet.style.borderColor = "red"; // Set the border color of the input field to red
    }
}

// Validation du champ "Prix min" (entier)
function validatePrixInitial() {
    var prixInitial = document.getElementById("prix-min");
    var prixInitialError = document.getElementById("prix-objet-error");
    var pricePattern = /^(?!(?:0|0\.0|0\.00)$)[+]?\d+(\.\d|\.\d[0-9])?$/; 

    if (pricePattern.test(prixInitial.value)) {
        prixInitialError.innerHTML = "";
        prixInitial.style.border = "none";
        prixInitial.style.borderColor = "green";
    } else {
        prixInitialError.innerHTML = "Prix Initial est obligatoire et doit être un nombre entier";
        prixInitial.style.border = "1.5px solid red";
        prixInitial.style.borderColor = "red";
    }
}


var dateDebut = document.getElementById("date-debut");
var dateFin = document.getElementById("date-fin");
var dateDebutError = document.getElementById("date-debut-error");
var dateFinError = document.getElementById("date-fin-error");

function verifierDates() {
    // Récupérer les valeurs des champs de date
    var dateDebutValue = dateDebut.value;
    var dateFinValue = dateFin.value;

    // Réinitialiser les messages d'erreur
    dateDebutError.innerHTML = "";
    dateFinError.innerHTML = "";

    // Convertir les chaînes de date en objets Date
    var dateDebutObj = new Date(dateDebutValue);
    var dateFinObj = new Date(dateFinValue);

    // Vérifier si la date de fin est après la date de début
    if (dateFinObj <= dateDebutObj) {
        dateFinError.innerHTML = "La date de fin doit être après la date de début.";
        return false;
    }

    // Si toutes les vérifications sont réussies
    return true;
}




document.addEventListener("DOMContentLoaded", function() {
    const formu = document.querySelector('form');
    formu.addEventListener("input", function(e) { 
        e.preventDefault();
        validernom();
        verifierDates(); 
        validatePrixInitial();
    });
});
