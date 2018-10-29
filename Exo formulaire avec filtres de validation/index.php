<?php

// Vérification que les champs sont tous là
if(isset($_POST['age']) && isset($_POST['email']) && isset($_POST['website'])){

    // Tests des champs
    if(!filter_var($_POST['age'], FILTER_VALIDATE_INT) || $_POST['age'] < 0){
        $errors[] = 'Age invalide';
    }

    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $errors[] = 'Email invalide';
    }

    if(!filter_var($_POST['website'], FILTER_VALIDATE_URL)){
        $errors[] = 'URL invalide';
    }

    // Si il n'y a pas d'erreurs, on crée un message
    if(!isset($errors)){
        $success = 'Formulaire envoyé !';

        // Ici les actions effectuées si le formulaire servait à faire une véritable action
    }

}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exercice formulaire</title>
</head>
<body>
<?php

    // Si success n'existe pas, ona ffiche le formulaire
    if(!isset($success)){
?>
    <form action="index.php" method="POST">
        <input type="text" placeholder="age" name="age">
        <input type="text" placeholder="email" name="email">
        <input type="text" placeholder="website" name="website">
        <input type="submit">
    </form>
<?php
    }

    //  Si il y a des erreurs, on les affiches
    if(isset($errors)){
        foreach($errors as $error){
            echo '<p style="color:red;">' . $error . '</p>';
        }
    }

    // Si success existe, on l'affiche
    if(isset($success)){
        echo '<p style="color:green;">' . $success . '</p>';
    }

?>

</body>
</html>