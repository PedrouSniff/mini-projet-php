<?php
    $bdd = new PDO('mysql:host=localhost;dbname=film;charset=utf8','root','');

    $request = $bdd ->prepare(' SELECT * FROM film');

    $request->execute([]);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="PumpkinSpiceNyan.gif" type="image/x-icon">
    <link rel="stylesheet" href="assets/style.css">
    <title>Principale</title>
</head>
<body>
    <?php include "nav.php" ?>
    <h1>Récupération de la BDD</h1>
    <?php while($data = $request->fetch()): ?>
    <article>
        <h3>Titre</h3>
            <?php
               echo $data['titre'];
            ?>
        <h4>Durée</h4>
            <?php
                $dureeh = $data['duree']/60;
                $dureemin = $data['duree']%60;
                $dureef = round($dureeh) . " heure et " . $dureemin. " minutes";
                echo $dureef
            ?>
        <h4>La date de sortie</h4>
            <?php
               echo $data['date_de_sortie'];
            ?>
            <?php if (!empty($data['images'])): ?>
                <img src="<?php echo htmlspecialchars($data['images']); ?>" alt="image film" style="width: 200px; height: auto;">
            <?php endif ?>
            <a href="voirplus.php?id=<?php echo $data['id'] ?>">Voir plus</a>
            <a href="modifier.php?id=<?php echo $data['id'] ?>">Modifier</a>
            <a href="delete.php?id=<?php echo $data['id']?>">Supprimer</a>
    </article>
    <?php endwhile ?>
</body> 
</html>