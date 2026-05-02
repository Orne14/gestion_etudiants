<?php
require "config/db.php";

// 1. Vérifier si le formulaire est envoyé
if (isset($_POST['nom'], $_POST['prenom'], $_POST['filiere_id'])) {

    // 2. Récupération des données
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $filiere_id = $_POST['filiere_id'];

    // 3. Requête préparée (sécurisée)
    $sql = "INSERT INTO etudiants (nom, prenom, filiere_id)
            VALUES (:nom, :prenom, :filiere_id)";

    $stmt = $db->prepare($sql);

    $stmt->execute([
        ":nom" => $nom,
        ":prenom" => $prenom,
        ":filiere_id" => $filiere_id
    ]);

    // 4. Redirection
    header("Location: index.php?success=1");
    exit();
}
?>