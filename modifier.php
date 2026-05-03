<?php
require "config/db.php";

// Vérification
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

// Récupérer étudiant
$stmt = $db->prepare("SELECT * FROM etudiants WHERE id = :id");
$stmt->execute([":id" => $id]);
$etudiant = $stmt->fetch();

if (!$etudiant) {
    header("Location: index.php");
    exit();
}

// Récupérer filières
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
    <div class="header">
       🎓 Gestion Étudiants
    </div>

<div class="container">

<h2>Modifier un étudiant</h2>

<p id="error"></p>

<form action="update.php" method="POST">

    <input type="hidden" name="id" value="<?= $etudiant['id'] ?>">

    <input type="text" name="nom"
        value="<?= htmlspecialchars($etudiant['nom'], ENT_QUOTES, 'UTF-8') ?>">

    <input type="text" name="prenom"
        value="<?= htmlspecialchars($etudiant['prenom'], ENT_QUOTES, 'UTF-8') ?>">

    <select name="filiere_id">
        <?php foreach ($filieres as $filiere): ?>
            <option value="<?= $filiere['id'] ?>"
                <?= $filiere['id'] == $etudiant['filiere_id'] ? 'selected' : '' ?>>
                <?= $filiere['nom'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <div style="display:flex; gap:10px; justify-content:center;">
        <button type="submit">Modifier</button>
        <a href="index.php" class="btn btn-cancel">Annuler</a>
    </div>

</form>

</div>

<script src="assets/js/script.js"></script>
</body>
</html>