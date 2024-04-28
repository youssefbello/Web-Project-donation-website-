var global_email = 0;
const confirmEmail = () => {
    var email = document.getElementById("email").value;
    const emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    var validEmail = emailRegex.test(email);
    var emailSpan = document.getElementById("eSpan");
    var emailElement = document.getElementById("email");
    if (email.length >= 10) {
        if (!validEmail) {
            emailSpan.innerHTML = "<h6>&#10007; INCORRECT EMAIL FORMAT</h6>";
            emailSpan.setAttribute("style", "color: red");
            emailElement.style.borderColor = "red";
            emailElement.style.border = "1.5px solid";
            global_email = 0;
        } else {
            emailElement.border = "1.5px solid";
            emailElement.style.borderColor = "green";
            emailSpan.innerHTML = "";
            global_email = 1;
        }
    } else {
        emailSpan.innerHTML = "";
        return 1;
    }
}

document.getElementById("email").addEventListener("keyup", confirmEmail);
document.getElementById("submit").addEventListener("click", function(event) {
    if (!global_email) {
        event.preventDefault();
    } else {
        event.submit();
    }
});
