<?php
try {
    $db = new PDO(
        "mysql:host=localhost;dbname=gestion_etudiants",
        "root",
        ""
    );

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (Exception $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>