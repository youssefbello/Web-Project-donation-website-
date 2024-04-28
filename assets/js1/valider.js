function validerEtSoumettre(event) {
    event.preventDefault(); // Empêche la soumission automatique

    var nom = document.getElementById("nom").value;
    var prenom = document.getElementById("pre").value;
    var email = document.getElementById("email").value;
    var area = document.getElementById("area").value;
    var tel = document.getElementById("tel").value;
    var rad = document.getElementById("radio").value;
    var cin = document.getElementById("cin").value;
    var span1 = document.getElementById("s1");
    var span2 = document.getElementById("s2");
    var span3 = document.getElementById("s3");
    var span4 = document.getElementById("s4");
    var span5 = document.getElementById("s5");
    var span6 = document.getElementById("s6");
    var k = 0;

    // Validation du prénom
    if (!/^[A-Za-z]+$/.test(prenom)) {
        span1.innerHTML = "correct";
        span1.style.color = "green";
        k++;
    } else {
        span1.innerHTML = "incorrect";
        span1.style.color = "red";
        event.preventDefault(); // Empêche la soumission automatique
    }

    // Validation du nom
    if (!/^[A-Za-z]+$/.test(nom)) {
        span2.innerHTML = "correct";
        span2.style.color = "green";
        k++;
    } else {
        span2.innerHTML = "incorrect.";
        span2.style.color = "red";
        event.preventDefault(); // Empêche la soumission automatique
    }

    // Validation de l'e-mail
    if (!/^\S+@\S+\.\S+$/.test(email)) {
        span3.innerHTML = "incorrect";
        span3.style.color = "red";
        event.preventDefault();
    } else {
        span3.innerHTML = "correct";
        span3.style.color = "green";
        k++;
    }

    // Validation de l'area
    if (area.startsWith("+") && area.length === 4 && /^\d+$/.test(area.substring(1))) {
        span4.innerHTML = "correct";
        span4.style.color = "green";
        k++;
    } else {
        span4.innerHTML = "incorrect";
        span4.style.color = "red";
        event.preventDefault(); // Empêche la soumission automatique
    }

    // Validation du téléphone
    if (/^\d{8}$/.test(tel)) {
        span5.innerHTML = "correct";
        span5.style.color = "green";
        k++;
    } else {
        span5.innerHTML = "incorrect";
        span5.style.color = "red";
        event.preventDefault(); // Empêche la soumission automatique
    }

    // Validation du cin
    if (/^\d{14}$/.test(cin)) {
        span6.innerHTML = "correct";
        span6.style.color = "green";
        k++;
    } else {
        span6.innerHTML = "incorrect";
        span6.style.color = "red";
        event.preventDefault(); // Empêche la soumission automatique
    }

    // Si la validation réussit
    if (k === 6) {
        // Soumettre le formulaire
        document.getElementById("form").submit();

        // Rediriger l'utilisateur vers la page initiale
        window.location.href = "eventa.html";
    }
}
