<?php

// Si un id est présent dans l'url
if(isset($_GET['id'])){

    // On vérifie qu'il soit valide
    if(!filter_var($_GET['id'], FILTER_VALIDATE_INT) || $_GET['id'] < 1){
        $errors[] = 'fruit invalide';
    }

    // Si pas d'erreurs
    if(!isset($errors)){

        // Connexion BDD
        try{
            $bdd = new PDO('mysql:host=localhost;dbname=wf3;charset=utf8', 'root', '');
        } catch(Exception $e){
            die('Erreur bdd');
        }

        // Affichage erreurs SQL
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête SQL préparée pour récupérer les infos du fruit correspondant à l'id passé dans l'url
        $response = $bdd->prepare('SELECT * FROM fruits WHERE id = ?');
        $response->execute(array(
            $_GET['id']
        ));

        // Convertions du résultat de la requête en array PHP associatif
        $fruit = $response->fetch(PDO::FETCH_ASSOC);

        // Si $fruit est vide, c'est qu'aucun fruit correspondant n'a été trouvé, donc erreur
        if(empty($fruit)){
            $errors[] = 'Fruit inexistant';
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
    <title>Affichage fruit</title>
</head>
<body>
    
<?php

// Si il y a des erreurs, on les affiches, sinon si $fruit existe, on affiche toutes ses infos sous forme de table HTML
if(isset($errors)){
    foreach($errors as $error){
        echo '<p style="color:red;">' . $error . '</p>';
    }
} elseif(isset($fruit)){
?>

<table>
    <tr>
        <td><?php echo htmlspecialchars($fruit['fruit_name']) ?></td>
        <td><?php echo htmlspecialchars($fruit['fruit_color']) ?></td>
        <td><?php echo htmlspecialchars($fruit['fruit_description']) ?></td>
        <td><?php echo htmlspecialchars($fruit['fruit_origin']) ?></td>
        <td><?php echo htmlspecialchars($fruit['fruit_price']) ?></td>
    </tr>
</table>

<a href="index.php">Retour</a>

<?php
}

?>

</body>
</html>