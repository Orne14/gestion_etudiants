<?php
require "config/db.php";

if (isset($_POST['id'], $_POST['nom'], $_POST['prenom'], $_POST['filiere_id'])) {

    $id = $_POST['id'];
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $filiere_id = $_POST['filiere_id'];

    $sql = "UPDATE etudiants 
            SET nom = :nom, prenom = :prenom, filiere_id = :filiere_id
            WHERE id = :id";

    $stmt = $db->prepare($sql);

    $stmt->execute([
        ":nom" => $nom,
        ":prenom" => $prenom,
        ":filiere_id" => $filiere_id,
        ":id" => $id
    ]);
}

header("Location: index.php?updated=1");
exit();
?>