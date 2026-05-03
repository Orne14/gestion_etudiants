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

/* message de succès pour enregistrement étudiant*/
const successMessage = document.getElementById("success-message");

if (successMessage) {
    setTimeout(() => {
        successMessage.style.display = "none";
    }, 3000); // 3000 ms = 3 secondes
}

if (successMessage) {
    setTimeout(() => {
        successMessage.style.opacity = "0";
        successMessage.style.transition = "0.5s";
    }, 2500);
}

/* confirmation de suppression */
const deleteButtons = document.querySelectorAll(".delete-btn");

deleteButtons.forEach(button => {
    button.addEventListener("click", function(e) {
        const confirmDelete = confirm("Voulez-vous vraiment supprimer cet étudiant ?");
        
        if (!confirmDelete) {
            e.preventDefault(); // empêche la suppression
        }
    });
});