<?php

// Liste des pays autorisés pour la liste déroulante dans le formulaire
$countries = array('france', 'allemagne', 'espagne', 'italie', 'chine');

// Si tous les champs du formulaire sont là
if(
    isset($_POST['name']) &&
    isset($_POST['color']) &&
    isset($_POST['origin']) &&
    isset($_POST['description']) &&
    isset($_POST['price'])
){
    
    // Bloc vérifications des champs
    if(!preg_match('#^[a-z\'\- ]{2,30}$#i', $_POST['name'])){
        $errors['name'] = 'Nom invalide';
    }

    if(!preg_match('#^[a-z\-]{2,20}$#i', $_POST['color'])){
        $errors['color'] = 'Couleur invalide';
    }

    // Si le pays envoyé par le formulaire n'est pas dans la liste des pays autorisés, erreur
    if(!in_array($_POST['origin'], $countries)){
        $errors['origin'] = 'Pays invalide !';
    }

    if(!preg_match('#^[\w \-\.\'\" ]{0,5000}$#', $_POST['description'])){
        $errors['description'] = 'Description invalide !';
    }

    if(!preg_match('#^[0-9]{1,5}([\.,][0-9]{1,2})?$#', $_POST['price'])){
        $errors['price'] = 'Prix invalide !';
    }

    // Si pas d'erreurs
    if(!isset($errors)){

        // Connexion à la BDD
        try{
            $bdd = new PDO('mysql:host=localhost;dbname=wf3;charset=utf8', 'root', '');
        } catch(Exception $e){
            die('Erreur de connection à la BDD');
        }

        // Afficher les erreurs SQL si il y en a
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insertion avec une requête préparée (protégée contre injection SQL !) d'un nouveau fruit
        $response = $bdd->prepare('INSERT INTO fruits(fruit_name, fruit_color, fruit_description, fruit_origin, fruit_price) VALUES(:name, :color, :description, :origin, :price)');

        // Liaison de :name dans la requête avec $_POST['name'], etc..
        $response->bindValue('name', $_POST['name']);
        $response->bindValue('color', $_POST['color']);
        $response->bindValue('description', $_POST['description']);
        $response->bindValue('origin', $_POST['origin']);
        $response->bindValue('price', $_POST['price']);

        // Execution de la requête SQL
        $response->execute();

        // Si la requête a affecté aucune ligne, il y a eu une erreur, sinon tout va bien
        if($response->rowCount() > 0){
            $success = 'Fruit inséré !';
        } else {
            $errors['other'] = 'Erreur dans la bdd';
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
    <title>Exercice création fruit</title>
</head>
<body>
    
    <?php

    // Si success n'existe pas, ona ffiche le formulaire, sinon on affiche le message de succès
    if(!isset($success)){
    ?>
    <form action="index.php" method="POST">
        <p>
            <input type="text" name="name" placeholder="name">
            <?php
            // Si errors['name'] existe, je l'affiche ici en dessous du champ name
            if(isset($errors['name'])){
                echo '<p style="color:red;">' . $errors['name'] . '</p>';
            } ?>
        </p>
        <p>
            <input type="text" name="color" placeholder="color">
            <?php if(isset($errors['color'])){
                echo '<p style="color:red;">' . $errors['color'] . '</p>';
            } ?>
        </p>
        <p>
            <input type="text" name="description" placeholder="description">
            <?php if(isset($errors['description'])){
                echo '<p style="color:red;">' . $errors['description'] . '</p>';
            } ?>
        </p>
        <p>
            <input type="text" name="price" placeholder="price">
            <?php if(isset($errors['price'])){
                echo '<p style="color:red;">' . $errors['price'] . '</p>';
            } ?>
        </p>
        <p>
            <select name="origin">
            <?php
                // Pour chaque pays dans le tableau, on crée une option dans le select
                foreach($countries as $country){
                    echo '<option value="' . $country . '">' . ucfirst($country) . '</option>';
                }
            ?>
            </select>
            <?php if(isset($errors['origin'])){
                echo '<p style="color:red;">' . $errors['origin'] . '</p>';
            } ?>
        </p>
        <input type="submit">
    </form>
    <?php

        // Si l'erreur 'other' existe, on l'affiche en dessous du formulaire
        if(isset($errors['other'])){
            echo '<p style="color:red;">' . $errors['other'] . '</p>';
        }

    } else {
        echo '<p style="color:green;">' . $success . '</p>';
    }
    ?>

</body>
</html>