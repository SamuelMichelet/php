<?php

// Vérification que tous les éléments attendus sont présents

if(isset($_POST['name']) && isset($_POST['firstname']) && isset($_POST['age'])){
    
    // vérifications des champs (n champs de formulaire = n vérifications)

    if(mb_strlen($_POST['name']) > 40 || mb_strlen($_POST['name']) < 2){
        $errors[] = 'Le champ nom doit contenir entre 2 et 40 caractères';
    }

    if(mb_strlen($_POST['firstname']) > 40 || mb_strlen($_POST['firstname']) < 2){
        $errors[] = 'Le champ prénom doit contenir entre 2 et 40 caractères';
    }

    if(!ctype_digit($_POST['age']) || $_POST['age'] <= 0 || $_POST['age'] > 1000){
        $errors[] = 'Age doit être un entier positif entre 0 et 1000';
    }

    // Si il n'y a pas d'erreurs, on crée le message de succès
    if(!isset($errors)){
        $success = 'Salut ' . htmlspecialchars($_POST['firstname']) . ' ' . htmlspecialchars($_POST['name']) . ', tu as ' . htmlspecialchars($_POST['age']) . ' ans';
    }

} else {
    $errors[] = 'Tous les champs doivent être présents';
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <?php
    
    if(isset($errors)){
        foreach($errors as $error){
            echo '<p style="color:red;">' . $error . '</p>';
        }
    }

    if(isset($success)){
        echo '<p style="color:green;">' . $success . '</p>';
    }
    ?>

</body>
</html>