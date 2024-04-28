function verifNom(nomSaisie) {
    var format = /^[A-Za-z]+$/;
    if (nomSaisie.match(format)) {
      return true;
    } else {
      return false;
    }
}

function verifEmail(emailSaisie) {
    var format = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    return format.test(emailSaisie);
}

function verifNumeroTelephone(phoneSaisie) {
    if (phoneSaisie.length === 8) {
        return true;
    } else {
        return false;
    }
}

function verif() {
    let nom = document.getElementById("nom").value;
    let email = document.getElementById("email").value;
    let phone = document.getElementById("phone").value;
    let sujet = document.getElementById("sujet").value;
    let description = document.getElementById("description").value;
  
    if (nom === "") {
      alert("Veuillez saisir votre nom.");
      return false;
    }

    if (verifNom(nom) === false) {
        alert("Votre nom doit contenir seulement des lettres.");
        return false;
    }
  
    if (email === "") {
      alert("Veuillez saisir l'email.");
      return false;
    }

    if(verifEmail(email) === false){
        alert("Veuillez respecter la forme de l'email.");
        return false;
    }

    if (phone === "") {
        alert("Veuillez saisir le numéro de téléphone.");
        return false;
    }

    if(verifNumeroTelephone(phone) === false){
        alert("Votre numéro de téléphone doit contenir exactement 8 chiffres.");
        return false;
    }
  

    if (sujet === "") {
        alert("Veuillez saisir le sujet.");
        return false;
    }

    if (description === "") {
        alert("Veuillez saisir la description.");
        return false;
    }
  
    return true;
  }
  