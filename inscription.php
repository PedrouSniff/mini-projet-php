<?php 
    $bdd = new PDO('mysql:host=localhost;dbname=film;charset=utf8','root','');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
<?php include "nav.php"; ?>
<h2>authentification</h2>
    <form id="auth" action="inscription.php#auth" method="POST">
        <label for="uti">Nom d'utilisateur</label>
        <input type="text" name="uti" id="uti" required>
        <label for="mdp">Votre mot de passe</label>
        <input type="password" name="mdp" id="mdp" required>
        <button>S'inscrire</button>
    </form>

    <?php     

    if (isset($_POST["mdp"]) && isset($_POST["uti"])){
        $mdp = htmlspecialchars($_POST['mdp']);
        $uti = htmlspecialchars($_POST['uti']);

        $mdpArgon = password_hash($mdp, PASSWORD_ARGON2I);

        $request = $bdd-> prepare('INSERT INTO user (user, password) VALUES (:user,:password)');

        $request -> execute([
            'user' => $uti,
            'password' => $mdpArgon
        ]);
        header("location:index.php");
    }else {
        echo "Erreur d'inscription. Réessayez !";
    } 
    
    ?>
</body>
</html>