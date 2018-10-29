<?php

// Si le cookie bgcolor existe déjà, on l'utilise pour changer la couleur de fond, sinon on met une couleur blanche par défaut
if(isset($_COOKIE['bgcolor'])){
    $color = $_COOKIE['bgcolor'];
} else {
    $color = 'white';
}

// Vérification que toutes les variables attendues sont présentes
if(isset($_POST['color'])){

    // Vérification que le champ du formulaire est valide
    if(mb_strlen($_POST['color']) > 7){
        $errors[] = 'Couleur incorrecte';
    }

    // Si pas d'erreurs, on crée un nouveau cookie bgcolor avec la nouvelle couleur et on crée un message de succès
    if(!isset($errors)){

        $success = 'La couleur a bien été changée !';
        $color = $_POST['color'];
        setcookie('bgcolor', $_POST['color'], time() + 7200, null, null, false, true);
        
    }

}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exercice changement couleur</title>
</head>
<body style="background-color:<?php echo htmlspecialchars($color);  // affichage sécurisé de la couleur de fond de la page ?>;">
    
    <form action="color.php" method="POST">
        <input type="text" name="color" placeholder="couleur">
        <input type="submit">
    </form>
    <?php

    // Si errors existe, c'est qu'il y a des erreurs à afficher, donc on les parcours avec foreach et on els affiche en rouge
    if(isset($errors)){
        foreach($errors as $error){
            echo '<p style="color:red;">' . $error . '</p>';
        }
    }

    // Si success existe, on l'affiche en vert
    if(isset($success)){
        echo '<p style="color:green;">' . $success . '</p>';
    }

    ?>

</body>
</html>