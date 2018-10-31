<?php

// Si il y a bien une recherche
if(isset($_GET['search'])){
    
    // On vérifie si la recherche est correcte (pas de caractères interdits)
    if(!preg_match('#^[a-z]{2,50}$#', $_GET['search'])){
        $errors[] = 'Recherche invalide , trop courte ou trop longue';
    }

    // Si pas d'erreurs
    if(!isset($errors)){

        // Connexion BDD
        try{
            $bdd = new PDO('mysql:host=localhost;dbname=wf3;charset=utf8', 'root', '');
        } catch(Exception $e){
            die('Erreur bdd');
        }

        // Affichage des erreurs SQL
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête SQL avec like pour récupérer tous les fruits dont le nom comporte la recherche
        $response = $bdd->prepare('SELECT * FROM fruits WHERE fruit_name LIKE ?');
        $response->execute(array(
            '%' . $_GET['search'] . '%' // Il faut bien concaténer les % ici et non dans la requête sinon plantage
        ));

        // On récupère tous les fruits trouvés dans un array PHP associatif
        $fruits = $response->fetchAll(PDO::FETCH_ASSOC);

        // Si il n'y a aps de fruits, message d'erreur
        if(empty($fruits)){
            $errors[] = 'Aucun résultat à la recherche';
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
    <title>Moteur recherche fruits</title>
</head>
<body>
    <form action="index.php" method="GET">
        <input type="text" name="search" placeholder="Recherche">
        <input type="submit">
    </form>

<?php

// Si il y a des erreurs, on les affiches, sinon on affiche les fruits sous forme de table HTML
if(isset($errors)){
    foreach($errors as $error){
        echo '<p style="color:red;">' . $error . '</p>';
    }
} elseif(isset($fruits)){

    echo '<table>';
    foreach($fruits as $fruit){
        echo '
        <tr>
            <td>'.htmlspecialchars($fruit['id']).'</td>
            <td>'.htmlspecialchars($fruit['fruit_name']).'</td>
            <td>'.htmlspecialchars($fruit['fruit_color']).'</td>
            <td>'.htmlspecialchars($fruit['fruit_origin']).'</td>
            <td><a href="fruit.php?id=' . htmlspecialchars($fruit['id']) . '">En savoir plus</a></td>
        </tr>'; // Affichage d'un lien vers la page fruit.php avec l'id du fruit pour voir en détail ce fruit
    }
    echo '</table>';

}

?>

</body>
</html>