<?php
require "config/db.php";

//Récupération des filières
$filieres = $db->query("SELECT * FROM filieres")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des étudiants</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <p id="error" style="color:red; text-align:center;"></p>
    <form action="traitement.php" method="POST">
    <h2>Ajouter un étudiant</h2>

    <input type="text" name="nom" placeholder="Nom">
    <input type="text" name="prenom" placeholder="Prénom">

    <select name="filiere_id" required>
        <option value="">Choisir une filière</option>

        <?php foreach($filieres as $filiere): ?>
            <option value="<?= $filiere['id'] ?>">
                <?= $filiere['nom'] ?>
            </option>
        <?php endforeach; ?>

    </select>

    <button type="submit">Ajouter</button>
</form>


<script src="assets/js/script.js"></script>
</body>
</html>