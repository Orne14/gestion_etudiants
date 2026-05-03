<?php
require "config/db.php";

// Vérifier si id existe
if (isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])) {

    $id = $_GET['id'];

    // Requête sécurisée
    $sql = "DELETE FROM etudiants WHERE id = :id";
    $stmt = $db->prepare($sql);

    $stmt->execute([
        ":id" => $id
    ]);
}

// Redirection
header("Location: index.php?deleted=1");
exit();
?>