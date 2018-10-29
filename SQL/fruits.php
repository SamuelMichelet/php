<?php

// PHP Data Object
// mysql:host=localhost;dbname=wf3; = DSN (infos de connexion)
// charset=utf8 = encodage (optionnel mais recommandé)
try{
    $bdd = new PDO('mysql:host=localhost;dbname=wf3;charset=utf8', 'root', '');
} catch(Exception $e){
    die('Erreur : ' . $e->getMessage());
}

// Active l'affichage des erreurs SQL
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Fait une requête SQL dans la BDD. (response contient le résultat de la requête brute, non exploitable en PHP)
$response = $bdd->query('SELECT * FROM fruits ORDER BY fruit_name');

// Converti les données brutes dans response en un tableau PHP stocké dans la variable $fruits.
// ->fetch() permet de récupérer le premier résultat de la requête uniquement sous forme de tableau associatif PHP
// ->fetchAll() permet de récupérer tous les résultats de la requête sous forme de tableau bidimensionnel PHP.
// en paramètre de fetch() et fetchAll() il est possible de préciser sous quel forme de tableau on veut le résultat :
// PDO::FETCH_ASSOC (tableau associatif)
// PDO::FETCH_NUM (numéroté)
$fruits = $response->fetchAll(PDO::FETCH_ASSOC);

// Ferme la connexion de la requête $response. Toujours faire après et non avant le fetch ou le fetchAll sur response.
$response->closeCursor();

?>

<ul>
<?php
    // Affichage des fruits en liste à puce html
    foreach($fruits as $fruit){
        echo '<li>' . htmlspecialchars($fruit['fruit_name']) . '</li>';
    }

?>
</ul>