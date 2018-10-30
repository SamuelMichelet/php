<?php
/*
1) Créer une table "articles" avec les champs suivants : id, title(varchar 50), date(date), author(varchar 30), content(varchar 2000).
Remplir cette table manuellement (onglet insérer) avec 20 faux articles (remplir avec du lorem et des fausses infos, on passe pas 1h là dessus)
2) On fait passer le numéro de la page demandée en GET (?page=1).
On souhaite afficher seulement 5 articles par page.
Calculer la LIMIT et le OFFSET à partir de ces données.
3) Vérifier que le numéro de la page est valide avec une regex, sinon lui donner la valeur 1 par défaut. Se connecter à la BDD et sélectionner les articles en se servant de $limit et $offset. Afficher juste le titre des articles sous forme de liste à puce HTML.
Erreur SQL : chercher à résoudre le pb avec le 3eme paramètre de la méthode bindValue de PDO
*/


// On déclare ici le nombre d'article à afficher par page au cas où on souhaiterais le modifier rapidement
$articlePerPage = 10;

// On vérifie si GET['page'] existe et contient bien un numéro de page valide, sinon on on met la page à afficher à 1 par défaut
if(isset($_GET['page']) AND preg_match('#^[1-9][0-9]{0,9}$#', $_GET['page'])){
    $pageNumber = $_GET['page'];
} else {
    $pageNumber = 1;
}

// On calcul ici le OFFSET qui nous servira dans la requête SQL à sélectionner les bons article selon la page demandée
$offset = ($pageNumber - 1) * $articlePerPage;

require('bdd.php');

// On récupère les articles de la page demandée, selon la nombre d'article à afficher par page (LIMIT) et la page demandée (OFFSET)
$getArticles = $bdd->prepare('SELECT * FROM articles LIMIT :limit OFFSET :offset');
// On utilise PDO::PARAM_INT en tant que 3eme paramètre de bindvalue pour forcer les 2 paramètres à être des entiers et non des chaînes de texte, sinon la requête plante.
$getArticles->bindValue(':limit', $articlePerPage, PDO::PARAM_INT);
$getArticles->bindValue(':offset', $offset, PDO::PARAM_INT);
$getArticles->execute();

// On récupère tous les articles trouvés par la requête SQL et on les met sous forme de tableau associatif dans $articles
$articles = $getArticles->fetchAll(PDO::FETCH_ASSOC);
$getArticles->closeCursor();

// On fait une nouvelle requête pour récupérer le nombre total d'article dans la BDD. ça servira plus loin pour générer le menu de navigation des pages
$getTotalArticle = $bdd->query('SELECT COUNT(id) AS total FROM articles');
$totalArticle = $getTotalArticle->fetch(PDO::FETCH_ASSOC)['total'];
$getTotalArticle->closeCursor();
// On arrondi la page max à l'unitée supérieur au cas où le nombre de page serait pas rond (ex: 15 articles sur la 1ere page et 5 sur la deuxieme donnerait 1.333 page, donc on arrondi à l'unitée supérieure pour bien avoir 2 pages)
$pageMax = ceil($totalArticle/$articlePerPage);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        .menu li{
            display:inline;
            margin:3px;
        }
    </style>
</head>
<body>
    <h1>Articles</h1>
    <?php
    
    // Si il y a des articles à afficher, on les affiche sinon on affiche un message d'erreur
    if(!empty($articles)){
        echo "<ul>";
        // Extraction de tous les articles avec un foreach
        foreach($articles as $article){
            echo '<li><strong><a href="article.php?id='.htmlspecialchars($article['id']).'">'.htmlspecialchars($article['title']).'</a></strong> écrit par <strong>'. htmlspecialchars($article['author']) .'</strong></li>';
        }
        echo "</ul>";
    } else {
        echo '<p style="color:red;">Pas d\'articles</p>';
    }
    
    ?>
    
    <ul class="menu">
        <!-- Bouton pour revenir à la page 1 (pas en PHP car ce bouton sera toujours fixe) -->
        <li><a href="index.php?page=1">Début</a></li>
        
        <?php
        
        // Bouton permettant d'aller à la page précédente si elle existe (plus grand que 0)
        if(($pageNumber-1)>0){
        echo '<li><a href="index.php?page=' . ($pageNumber-1) . '">&larr;</a></li>';
        }
        
        // Bouton permettant d'aller 2 pages avant la page courante si elle existe (plus grand que 0)
        if(($pageNumber-2)>0){
        echo '<li><a href="index.php?page=' . ($pageNumber-2) . '">' . ($pageNumber-2) . '</a></li>';
        }
        
        // Bouton permettant d'aller à la page précédent la page courante si elle existe (plus grand que 0)
        if(($pageNumber-1)>0){
        echo '<li><a href="index.php?page=' . ($pageNumber-1) . '">' . ($pageNumber-1) . '</a></li>';
        }
        
        // Affiche juste la page courante, sans lien (nous sommes déjà dessus)
        echo '<li>' . $pageNumber . '</li>';
        
        // Bouton permettant d'aller à la page suivant la page courante si elle existe (plus petite ou égal à la page maximum)
        if(($pageNumber+1) <= $pageMax){
        echo '<li><a href="index.php?page=' . ($pageNumber+1) . '">' . ($pageNumber+1) . '</a></li>';
        }
        
        // Bouton permettant d'aller 2 pages après la page courante si elle existe (plus petite ou égal à la page maximum)
        if(($pageNumber+2) <= $pageMax){
        echo '<li><a href="index.php?page=' . ($pageNumber+2) . '">' . ($pageNumber+2) . '</a></li>';
        }
        
        // Bouton permettant d'aller à la page suivante si elle existe (plus petite ou égal à la page maximum)
        if(($pageNumber+1) <= $pageMax){
        echo '<li><a href="index.php?page=' . ($pageNumber+1) . '">&rarr;</a></li>';
        }
        
        // Bouton permettant d'aller à la dernière page
        echo '<li><a href="index.php?page=' . $pageMax .'">Fin</a></li>';
        ?>
    </ul>
    
</body>
</html>