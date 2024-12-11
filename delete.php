<?php 
    $bdd = new PDO('mysql:host=localhost;dbname=film;charset=utf8','root','');

    if (isset($_GET['id'])) {
        $id = htmlspecialchars($_GET['id']);

        $requestfetch = $bdd ->prepare('    DELETE 
                                            FROM film 
                                            WHERE id = :id');
        $requestfetch->execute([
            'id' =>$id
        ]);

        header("location:index.php");
    };

?>