var cc = document.getElementById("cc");
var ccv = document.getElementById("ccv");
var ccSpan = document.getElementById("ccSpan");
var ccvSpan = document.getElementById("ccvSpan");

const checkCC = () => {
    const regex = /^[0-9]+$/;
    if (regex.test(cc)) {
        cc.style.border = "1.5px solid";
        cc.style.borderColor = "green";
    } else {
        cc.style.border = "1.5px solid";
        cc.style.borderColor = "red";
    }
}

cc.addEventListener("input", checkCC);