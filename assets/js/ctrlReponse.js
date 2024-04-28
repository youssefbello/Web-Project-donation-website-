function verif() {
    let description = document.getElementById("description").value;
  
    if (description === "") {
      alert("Veuillez saisir la description.");
      return false;
    }
  
    return true;
  }
  