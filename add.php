<?php
$bdd = new PDO('mysql:host=localhost;dbname=film;charset=utf8', 'root', '');

if (
    isset($_POST["titre"]) && isset($_POST["duree"]) && isset($_POST["date_de_sortie"]) && isset($_FILES['userfile'])
) {
    $titre = htmlspecialchars($_POST['titre']);
    $duree = htmlspecialchars($_POST['duree']);
    $date = htmlspecialchars($_POST['date_de_sortie']);
    
    $file = $_FILES['userfile'];
    $upload = 'uploads/';
    $Image = $upload . basename($file['name']);
    $fileType = strtolower(pathinfo($Image, PATHINFO_EXTENSION));

    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    
    if (in_array($fileType, $allowedTypes)) {
        if (move_uploaded_file($file['tmp_name'], $Image)) {
            $request = $bdd->prepare('
                INSERT INTO film (titre, duree, date_de_sortie, images)
                VALUES (:titre, :duree, :date_de_sortie, :images)
            ');

            $request->execute([
                'titre' => $titre,
                'duree' => $duree,
                'date_de_sortie' => $date,
                'images' => $Image
            ]);

            echo '<p>Film ajouté avec succès !</p>';
        } else {
            echo '<p>Erreur lors de l\'upload de l\'image.</p>';
        }
    } else {
        echo '<p>Type de fichier non autorisé. Formats acceptés : jpg, jpeg, png, gif.</p>';
    }
} else {
    echo '<p>Veuillez remplir tous les champs du formulaire et sélectionner une image.</p>';
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="PumpkinSpiceNyan.gif" type="image/x-icon">
    <link rel="stylesheet" href="assets/style.css">
    <title>Ajouter un film</title>
</head>
<body>
    <?php include "nav.php"; ?>

    <h1>Ajouter un film</h1>

    <form action="add.php" method="POST" enctype="multipart/form-data">
        <label for="titre">Le titre de votre film</label>
        <input type="text" id="titre" name="titre" required>

        <label for="duree">La durée en minutes</label>
        <input type="number" id="duree" name="duree" required>

        <label for="date_de_sortie">L'année de sortie du film</label>
        <input type="text" id="date_de_sortie" name="date_de_sortie" required>

        <label for="userfile">Votre image à uploader</label>
        <input type="file" name="userfile" id="userfile" required>

        <button type="submit">Ajouter</button>
    </form>
</body>
</html>