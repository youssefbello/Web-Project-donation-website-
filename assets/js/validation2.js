function validerEtSoumettre(event) {
  
    event.preventDefault(); 
    var obj = document.getElementById("obj").value;
    var place = document.getElementById("place").value;
    var dh = new Date(document.getElementById("dh").value); // Convertir la date en objet Date
    var bud = document.getElementById("bud").value;
    var be = document.getElementById("be").value;
    var nbrp = document.getElementById("nbrp").value;
    var type = document.getElementById("type").value;

    var span1 = document.getElementById("s1");
    var span2 = document.getElementById("s2");
    var span3 = document.getElementById("s3");
    var span4 = document.getElementById("s4");
    var span5 = document.getElementById("s5");
    var span6 = document.getElementById("s6");
    var span7 = document.getElementById("s7");
    
    var k = 0;
    var currentDate = new Date();

    // Validation du obj
    if (obj.length !== 0 && /^[A-Za-z]+$/.test(obj)) {
        span1.innerHTML = "correct";
        span1.style.color = "green";
        k++;
    } else {
        span1.innerHTML = "incorrect";
        span1.style.color = "red";
        event.preventDefault();
    }

    // Validation du place
    if (place.length !== 0 && /^[A-Za-z]+$/.test(place)) {
        span2.innerHTML = "correct";
        span2.style.color = "green";
        k++;
    } else {
        span2.innerHTML = "incorrect";
        span2.style.color = "red";
        event.preventDefault();
    }

    // Validation de la date
    if (!isNaN(dh) && dh > currentDate) {
        span3.innerHTML = "correct";
        span3.style.color = "green";
        k++;
    } else {
        span3.innerHTML = "incorrect";
        span3.style.color = "red";
        event.preventDefault();
    }

    // Validation du budget
    if (!isNaN(bud) && bud > 5000000) {
        span4.innerHTML = "correct";
        span4.style.color = "green";
        k++;
    } else {
        span4.innerHTML = "incorrect";
        span4.style.color = "red";
        event.preventDefault();
    }

    // Validation du be
    if (be.length !== 0 && /^[A-Za-z]+$/.test(be)) {
        span5.innerHTML = "correct";
        span5.style.color = "green";
        k++;
    } else {
        span5.innerHTML = "incorrect";
        span5.style.color = "red";
        event.preventDefault();
    }

    // Validation du nbrp
    if (!isNaN(nbrp) && nbrp > 100) {
        span6.innerHTML = "correct";
        span6.style.color = "green";
        k++;
    } else {
        span6.innerHTML = "incorrect";
        span6.style.color = "red";
        event.preventDefault();
    }

// Validation du type
if (type.length !== 0 &&  /^[A-Za-z]+$/.test(type) ) {
    span7.innerHTML = "correct";
    span7.style.color = "green";
    k++;
} else {
    
    span7.innerHTML = "incorrect";
    span7.style.color = "red";
    event.preventDefault();
}

    if (k === 7) {
        // Soumettre le formulaire
        document.getElementById("form").submit();

        // Rediriger l'utilisateur vers la page initiale
        window.location.href = "eventa.php";
    }
}
