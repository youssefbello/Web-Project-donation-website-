//cond variables for prevention
var global_pass = 1;
var global_email = 1;
var global_firstname = 1;
var global_lastname = 1;
var global_username = 1;
var global_cpass = 1;
var global_tel = 1;

const passCheck = () => {
    
    var password = document.getElementById("password").value;
    var passElement = document.getElementById("password");
    var passwordCharacter = document.getElementById("p_character");
    var passwordNumber = document.getElementById("p_number");
    var passwordUpper = document.getElementById("p_upper");
    var passwordSpecial = document.getElementById("p_special");
    var pc, pn, pu, ps;

    if (password.length > 0) {
        if (password.length >= 8) {
            passwordCharacter.innerHTML = "&#10003; " + passwordCharacter.innerHTML.slice(1);
            passwordCharacter.setAttribute("style", "color: green");
            pc = 1;
        } else {
            passwordCharacter.innerHTML = "&#10007; " + passwordCharacter.innerHTML.slice(1);
            passwordCharacter.setAttribute("style", "color: red");
            pc = 0;
        } 

        var containsNumber = /\d/.test(password);
        if (containsNumber) {
            passwordNumber.innerHTML = "&#10003; " + passwordNumber.innerHTML.slice(1);
            passwordNumber.setAttribute("style", "color: green");
            pn = 1;
        } else {
            passwordNumber.innerHTML = "&#10007; " + passwordNumber.innerHTML.slice(1);
            passwordNumber.setAttribute("style", "color: red");
            pn = 0;
        }

        var containsUppercase = /[A-Z]/.test(password);
        if (containsUppercase) {
            passwordUpper.innerHTML = "&#10003; " + passwordUpper.innerHTML.slice(1);
            passwordUpper.setAttribute("style", "color: green");
            pu = 1;
        } else {
            passwordUpper.innerHTML = "&#10007; " + passwordUpper.innerHTML.slice(1);
            passwordUpper.setAttribute("style", "color: red");
            pu = 0;
        }

        var containsSpecialChar = /[^A-Za-z0-9]/.test(password);
        if (containsSpecialChar) {
            passwordSpecial.innerHTML = "&#10003; " + passwordSpecial.innerHTML.slice(1);
            passwordSpecial.setAttribute("style", "color: green");
            ps = 1;
        } else {
            passwordSpecial.innerHTML = "&#10007; " + passwordSpecial.innerHTML.slice(1);
            passwordSpecial.setAttribute("style", "color: red");
            ps = 0;
        }
        if (pc == 1 && pn == 1 && pu == 1 && ps == 1) {
            passElement.style.border = "1.5px solid";
            passElement.style.borderColor = "green";
            global_pass = 1;
        } else {
            passElement.style.border = "1.5px solid";
            passElement.style.borderColor = "red";
        }

    } else {
        passwordCharacter.setAttribute("style", "color: grey");
        passwordNumber.setAttribute("style", "color: grey");
        passwordSpecial.setAttribute("style", "color: grey");
        passwordUpper.setAttribute("style", "color: grey");
        passwordSpecial.innerHTML = "&#10007; " + passwordSpecial.innerHTML.slice(1);
        passwordUpper.innerHTML = "&#10007; " + passwordUpper.innerHTML.slice(1);
        passwordNumber.innerHTML = "&#10007; " + passwordNumber.innerHTML.slice(1);
        passwordCharacter.innerHTML = "&#10007; " + passwordCharacter.innerHTML.slice(1);
        global_pass = 0;
    }
}

const confirmPass = () => {
    var password = document.getElementById("password").value;
    var cpassword = document.getElementById("cpassword").value;
    var cpSpan = document.getElementById("cpSpan");
    var cpElement = document.getElementById("cpassword");

    if (password.length >= 8 && cpassword.length >= 8) {
        if (password == cpassword) {
            cpElement.style.border = "1.5px solid";
            cpElement.style.borderColor = "green";
            cpSpan.innerHTML = "";
            global_cpass = 1;
            return 1;
        } else {
            cpSpan.innerHTML = "<h6>&#10007; Does not match</h6>";
            cpSpan.setAttribute("style", "color: red");
            cpElement.style.border = "1.5px solid";
            cpElement.style.borderColor = "red";
            global_cpass = 0;
        }
    } else {
        cpSpan.innerHTML = "";
    }
}

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
const checkLast = () => {
    var lastname = document.getElementById("lastname").value;
    var lastElement = document.getElementById("lastname");
    var LastOnlyCharacters = /^[A-Za-z]+$/.test(lastname);
    var lnSpan = document.getElementById("lnSpan");
    var ln;
    if (lastname.length > 0) {
        if (!LastOnlyCharacters) {
            lnSpan.innerHTML = "<h6>&#10007; Last Name must contain only characters</h6>";
            lnSpan.setAttribute("style", "color: red");
            lastElement.style.border = "1.5px solid";
            lastElement.style.borderColor = "red";
            global_lastname = 0;
            return 0;
        }
        lastElement.style.border = "1.5px solid";
        lastElement.style.borderColor = "green";
        global_lastname = 1;
        return 1;
    } else {
        lnSpan.innerHTML = "";
    }
}

const checkName = () => {
    var name = document.getElementById("firstname").value;
    var NameOnlyCharacters = /^[A-Za-z]+$/.test(name);
    var fnSpan = document.getElementById("fnSpan");
    var nameElement = document.getElementById("firstname");

    if (name.length > 0) {
        if (!NameOnlyCharacters) {
            fnSpan.innerHTML = "<h6>&#10007; Name must contain only characters</h6>";
            fnSpan.setAttribute("style", "color: red");
            nameElement.style.border = "1.5px solid";
            nameElement.style.borderColor = "red";
            global_firstname = 0;
        } else {
            fnSpan.innerHTML = "";
            nameElement.style.border = "1.5px solid";
            nameElement.style.borderColor = "green";
            global_firstname = 1;
        }
    } else {
        fnSpan.innerHTML = "";
    }
}

const checkUsername = () => {
    var username = document.getElementById("username").value;
    var userElement = document.getElementById("username");
    var uspan = document.getElementById("uSpan");
    if (username.length >= 5) {
        userElement.style.border = "1.5px solid";
        userElement.style.borderColor = "green";
        uspan.innerHTML = "";
        global_username = 1;
    } else if (username.length > 0 && username.length < 5){
        uspan.innerHTML = "<h6>&#10007; Username must be at least 5 characters</h6>";
        uspan.setAttribute("style", "color : red");
        userElement.style.border = "1.5px solid";
        userElement.style.borderColor = "red";
        global_username = 0;
    } else {
        uspan.innerHTML = "";
    }
}

const confirmTel = () => {
    var numbersOnlyRegex = /^[0-9]+$/;
    var tel = document.getElementById("tel").value;
    var telElement = document.getElementById("tel");
    var tSpan = document.getElementById("tSpan");

    if (tel.length === 8) {
        if (numbersOnlyRegex.test(tel)) {
            telElement.style.border = "1.5px solid";
            telElement.style.borderColor = "green";
            tSpan.innerHTML = "";
            global_tel = 1;
        } else {
            tSpan.innerHTML = "<h6>&#10007; Phone number must be 8 characters and a valid number</h6>";
            telElement.style.border = "1.5px solid";
            telElement.style.borderColor = "red";
            global_tel = 0;
        }
    } else {
        tSpan.innerHTML = "";
    }
}
const confirmDOB = () => {
    var dob = document.getElementById("dob").value;
    var dobSpan = document.getElementById("dobSpan");
    var dobElement = document.getElementById("dob");

    if (dob.length > 0) {
        dobSpan.innerHTML = "";
        dobElement.style.border = "1.5px solid";
        dobElement.style.borderColor = "green";
        return 1;
    } else {
        dobSpan.innerHTML = "<h6>&#10007; Please enter your Date of Birth</h6>";
        dobSpan.setAttribute("style", "color: red");
        dobElement.style.border = "1.5px solid";
        dobElement.style.borderColor = "red";
        return 0;
    }
}

document.getElementById("dob").addEventListener("input", confirmDOB);
document.getElementById("email").addEventListener("keyup", confirmEmail);
document.getElementById("password").addEventListener("input", passCheck);
document.getElementById("cpassword").addEventListener("input", confirmPass);
document.getElementById("firstname").addEventListener("input", checkName);
document.getElementById("lastname").addEventListener("input", checkLast);
document.getElementById("username").addEventListener("input", checkUsername);
document.getElementById("tel").addEventListener("input", confirmTel);
document.getElementById("submit").addEventListener("click", function(event) {
    var notification = document.createElement("div");
    notification.innerHTML = "<p>Please complete all fields correctly!</p>";
    notification.classList.add("notification");

    if (global_cpass && global_email && global_pass && global_firstname && global_lastname && global_username && global_tel) {
        notification.innerHTML = "<p>Registration submitted successfully!</p>";
        notification.classList.add("success");
    }

    var closeButton = document.createElement("span");
    closeButton.innerHTML = "&times;";
    closeButton.classList.add("close");
    closeButton.onclick = function() {
        this.parentElement.style.display = 'none';
    };

    notification.appendChild(closeButton);
    document.body.appendChild(notification);

    setTimeout(function() {
        notification.style.display = 'none';
    }, 10000);

    if (!(global_cpass && global_email && global_pass && global_firstname && global_lastname && global_username && global_tel)) {
        event.preventDefault();
    }
});
