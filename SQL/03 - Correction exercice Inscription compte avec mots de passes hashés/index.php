<?php

// Si tous les champs du formulaire sont là
if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirmPassword'])){

    // Bloc de vérification des champs
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $errors[] = 'Email invalide';
    }

    if(!preg_match('#^.{5,500}$#', $_POST['password'])){
        $errors[] = 'Password invalide';
    }

    if($_POST['password'] != $_POST['confirmPassword']){
        $errors[] = 'Confirmation password invalide';
    }

    // Si il n'y a pas d'erreurs
    if(!isset($errors)){

        // Connexion à la BDD
        try{
            $bdd = new PDO('mysql:host=localhost;dbname=wf3;charset=utf8', 'root', '');
        } catch(Exception $e){
            die('Erreur de connexion à la bdd');
        }
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Selection du compte (hypothétique) ayant déjà l'adresse email dans le formulaire
        $verifyIfExist = $bdd->prepare('SELECT * FROM users WHERE email = ?');

        $verifyIfExist->execute(array(
            $_POST['email']
        ));

        $account = $verifyIfExist->fetch();

        // Si account est vide, c'est que l'email n'est pas utilisée, sinon erreur
        if(empty($account)){

            // Insertion du nouveau compte en BDD
            $response = $bdd->prepare('INSERT INTO users(email, password) VALUES(?,?)');
    
            $response->execute(array(
                $_POST['email'],
                password_hash($_POST['password'], PASSWORD_BCRYPT)
            ));
    
            // Si la requête SQL a touchée au moins 1 ligne tout vas bien, sinon erreur
            if($response->rowCount() > 0){
                $success = 'Compte créé !';
            } else {
                $errors[] = 'Problème lors de la création du compte.';
            }

        } else {
            $errors[] = 'Email déjà utilisée';
        }




    }

}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exercice inscription password hash</title>
</head>
<body>
    
<?php

// Si success n'existe pas, on affiche le formulaire, sinon ona ffiche success
if(!isset($success)){

?>
    <form action="index.php" method="POST">
        <input type="text" name="email" placeholder="email">
        <input type="password" name="password" placeholder="password">
        <input type="password" name="confirmPassword" placeholder="confirmPassword">
        <input type="submit">
    </form>
    <?php
} else {
    echo '<p style="color:green;">' . $success . '</p>';
}

// Si il y a des erreurs, on les affiches
if(isset($errors)){
    foreach($errors as $error){
        echo '<p style="color:red;">' . $error . '</p>';
    }
}
?>

</body>
</html>