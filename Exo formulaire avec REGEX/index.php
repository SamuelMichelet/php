<?php

// Appel des champs du formulaire
if(
    isset($_POST['email']) &&
    isset($_POST['password']) &&
    isset($_POST['confirmPassword']) &&
    isset($_POST['birthdate']) &&
    isset($_POST['zipCode'])
){

    // Vérification des champs

    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $errors[] = 'Email invalide';
    }

    if(!preg_match('#^.{5,300}$#', $_POST['password'])){
        $errors[] = 'MDP invalide';
    }

    if($_POST['password'] != $_POST['confirmPassword']){
        $errors[] = 'Confirmation MDP invalide';
    }

    if(!preg_match('#^((((19|[2-9]\d)\d{2})\-(0[13578]|1[02])\-(0[1-9]|[12]\d|3[01]))|(((19|[2-9]\d)\d{2})\-(0[13456789]|1[012])\-(0[1-9]|[12]\d|30))|(((19|[2-9]\d)\d{2})\-02\-(0[1-9]|1\d|2[0-8]))|(((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))\-02\-29))$#', $_POST['birthdate'])){
        $errors[] = 'Date invalide';
    }

    if(!preg_match('#^[0-9]{5}$#', $_POST['zipCode'])){
        $errors[] = 'Code postal invalide';
    }

    // Si pas d'erreur
    if(!isset($errors)){
        $success = 'Formulaire envoyé !';
    }

}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exercice formulaire avec regex</title>
</head>
<body>
    
<?php

// Si il n'y a pas de succès, on affiche le formulaire, sinon ona ffiche le message de succès
if(!isset($success)){ ?>
    <form action="index.php" method="POST">
        <input type="text" name="email" placeholder="email">
        <input type="password" name="password" placeholder="password">
        <input type="password" name="confirmPassword" placeholder="confirmPassword">
        <input type="text" name="birthdate" placeholder="birthdate">
        <input type="text" name="zipCode" placeholder="zipCode">
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