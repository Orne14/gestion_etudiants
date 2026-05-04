<?php
require "config/db.php";

// Nombre d'étudiants
$nbEtudiants = $db->query("SELECT COUNT(*) FROM etudiants")->fetchColumn();

// Nombre de filières
$nbFilieres = $db->query("SELECT COUNT(*) FROM filieres")->fetchColumn();

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
    <div class="header">
       🎓 Gestion Étudiants
    </div>

    <div class="dashboard">

        <div class="card">
            <h3>👨‍🎓 Nombres Étudiants</h3>
            <p><?= $nbEtudiants ?></p>
        </div>

        <div class="card">
            <h3>📚 Nombres Filières</h3>
            <p><?= $nbFilieres ?></p>
        </div>

    </div>

    <?php
        if (isset($_GET['success'])): ?>
            <p id="success-message" class="success">
                ✔ Étudiant ajouté avec succès
            </p>
        <?php endif; 
    ?>

    <?php if (isset($_GET['deleted'])): ?>
        <p id="success-message" class="success">
            ✔ Étudiant supprimé avec succès
        </p>
    <?php endif; ?>

    <?php if (isset($_GET['updated'])): ?>
        <p id="success-message" class="success">
            ✔ Étudiant modifié avec succès
        </p>
    <?php endif; ?>

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

    <?php if (count($etudiants) > 0): ?>

        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Filière</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($etudiants as $etudiant): ?>
                    <tr>
                        <td><?= htmlspecialchars($etudiant['nom']) ?></td>
                        <td><?= htmlspecialchars($etudiant['prenom']) ?></td>
                        <td><?= htmlspecialchars($etudiant['filiere_nom']) ?></td>
                        <td>
                            <a href="modifier.php?id=<?= $etudiant['id'] ?>" class="btn btn-edit">
                                Modifier
                            </a>
                            <a href="supprimer.php?id=<?= $etudiant['id'] ?>" class="btn btn-delete delete-btn">
                                Supprimer
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <?php else: ?>
        <p class="empty-message">Aucun étudiant enregistré pour le moment.</p>
    <?php endif; ?>

<script src="assets/js/script.js"></script>
</body>
</html>