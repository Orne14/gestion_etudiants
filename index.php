<?php
require "config/db.php";

//Récupération des filières
$filieres = $db->query("SELECT * FROM filieres")->fetchAll();

// Récupération des étudiants + filière (JOINTURE)
$etudiants = $db->query("
    SELECT etudiants.*, filieres.nom AS filiere_nom
    FROM etudiants
    JOIN filieres ON etudiants.filiere_id = filieres.id
")->fetchAll();
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
    <?php
    if (isset($_GET['success']) && $_GET['success'] == 1) {
        echo "<p style='color:green; text-align:center; font-weight:bold;'>
        ✔ Étudiant ajouté avec succès
        </p>";
    }
    ?>
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
    
    <h2>Liste des étudiants</h2>

    <table border="1" cellpadding="10" cellspacing="0" style="margin:auto; border-collapse:collapse;">
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Filière</th>
            <th>Actions</th>
        </tr>

        <?php foreach($etudiants as $etudiant): ?>
        <tr>
            <td><?= htmlspecialchars($etudiant['nom']) ?></td>
            <td><?= htmlspecialchars($etudiant['prenom']) ?></td>
            <td><?= htmlspecialchars($etudiant['filiere_nom']) ?></td>
            <td>
                <a href="#" class="btn btn-edit">Modifier</a>
                <a href="#" class="btn btn-delete">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>

<script src="assets/js/script.js"></script>
</body>
</html>