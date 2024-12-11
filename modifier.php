<?php
    $bdd = new PDO('mysql:host=localhost;dbname=film;charset=utf8','root','');

    if (isset($_GET['id'])) {
        $id = htmlspecialchars($_GET['id']);

        $requestfetch = $bdd ->prepare('    SELECT * 
                                            FROM film 
                                            WHERE id = :id');
        $requestfetch->execute([
            'id' =>$id
        ]);
        $data = $requestfetch->fetch();
    }


    if (isset($_POST["titre"]) && isset($_POST["duree"]) && isset($_POST["date_de_sortie"])){
        $titre = htmlspecialchars($_POST['titre']);
        $duree = htmlspecialchars($_POST['duree']);
        $date = htmlspecialchars($_POST['date_de_sortie']);
        $id = htmlspecialchars($id);

        $request = $bdd->prepare('  UPDATE `film` 
                                    SET 
                                        titre=:titre,
                                        duree=:duree,
                                        date_de_sortie=:date_de_sortie
                                    WHERE id=:id
                                ');

        $request->execute([
            'titre'             =>$titre,
            'duree'             =>$duree,
            'date_de_sortie'    =>$date,
            'id'                =>$id
        ]);
    };
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="PumpkinSpiceNyan.gif" type="image/x-icon">
    <link rel="stylesheet" href="assets/style.css">
    <title>Modifier un film</title>
</head>
<body>
    <?php include "nav.php" ?>

    <form action="modifier.php?id=<?php echo $data['id'] ?>" method="POST">
        <label for="titre">Le titre de votre film</label>
        <input type="text" id="titre" name="titre" placeholder="<?php echo $data['titre'] ;?>">
        

        <label for="duree">La duree en minute</label>
        <input type="number" id="duree" name="duree" placeholder="<?php echo $data['duree'];?>">

        <label for="date_de_sortie">L'annee de sortie du film</label>
        <input type="text" id="date_de_sortie" name="date_de_sortie" placeholder="<?php echo $data['date_de_sortie'] ;?>">

        <button>Modifier</button>
    </form> 


</body>
</html>