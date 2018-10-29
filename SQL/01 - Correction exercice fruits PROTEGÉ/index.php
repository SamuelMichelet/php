<?php

// Appel des éléments dont on a besoin (être sûr d'avoir tout les éléments)

if(isset($_GET['color']) && isset($_GET['origin'])){

    // Vérification du contenu des champs (être sûr que l'utilisateur n'a pas entré n'importe quoi)
    if(!preg_match('#^[a-z]{2,20}$#i', $_GET['color'])){
        $errors[] = 'Couleur invalide';
    }

    if(!preg_match('#^[a-z\-\' ]{2,70}$#i', $_GET['origin'])){
        $errors[] = 'Pays invalide';
    }

    //  Si pas d'erreur
    if(!isset($errors)){

        // Tentative de connexion à la BDD
        try{
            $bdd = new PDO('mysql:host=localhost;dbname=wf3;charset=utf8', 'root', '');
        } catch(Exception $e){
            die('Erreur de connection à la bdd');
        }

        // On prépare la requête en selectionnant tous les fruits correspondant à la couleur et à l'origine demandée (de façon sécurisée contre les injections SQL avec une requête préparée !)
        $response = $bdd->prepare('SELECT fruit_name FROM fruits WHERE fruit_color = ? AND fruit_origin = ?');

        $response->execute(array(
            $_GET['color'],     // premier '?'
            $_GET['origin']     // deuxième '?'
        ));

        // On récupère tous les fruits sous forme de tableaux associatifs
        $fruits = $response->fetchAll(PDO::FETCH_ASSOC);

        // Fermeture de la connexion à la BDD
        $response->closeCursor();

    }

}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des fruits</title>
</head>
<body>
<?php

// Si il y a des erreurs, on les affiches avec un foreach, sinon on affiche les fruits
if(isset($errors)){

    foreach($errors as $error){
        echo '<p>' . $errors . '</p>';
    }

} else {

    // Si $fruits est vide (aucun fruit qui correspond à la demande), ona ffiche une erreur, sinon on affiche les fruits avec un foreach
    if(empty($fruits)){
        echo '<p style="color:red;">Aucun fruit trouvé avec ces critères</p>';
    } else {
    
        echo '<ul>';
        foreach($fruits as $fruit){
            echo '<li>' . htmlspecialchars($fruit['fruit_name']) . '</li>';
        }
        echo '</ul>';
    
    }
}

?>

<form action="index.php" method="GET">
    <input type="text" name="color" placeholder="couleur">
    <input type="text" name="origin" placeholder="pays">
    <input type="submit">
</form>

</body>
</html>