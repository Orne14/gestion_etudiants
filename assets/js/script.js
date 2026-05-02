const form = document.querySelector("form");
const error = document.getElementById("error");

form.addEventListener("submit", function(e) {
    const nom = document.querySelector('input[name="nom"]').value.trim();
    const prenom = document.querySelector('input[name="prenom"]').value.trim();

    if (nom === "" || prenom === "") {
        e.preventDefault();
        error.textContent = "Veuillez remplir le nom et le prénom !";
    }
});