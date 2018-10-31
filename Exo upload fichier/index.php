<?php

// Si le formulaire a bien été envoyé
if(isset($_FILES['myImage'])){

    // On récupère le code d'erreur dans $fileError pour simplifier le code
    $fileError = $_FILES['myImage']['error'];

    // Si erreur4, fichier non envoyé
    if($fileError == 4){
        $errors[] = 'Aucun fichier n\'a été envoyé';
    }

    // Si erreur 1, 2 ou trop grand, erreur fichier trop grand
    if($fileError == 1 || $fileError == 2 || $_FILES['myImage']['size'] > 1000000){
        $errors[] = 'Fichier trop grand !';
    }

    // Si erreur 3, fichier reçu partiellement
    if($fileError == 3){
        $errors[] = 'Problème lors de l\'envoi du fichier';
    }

    // Si erreur 6, 7 ou 8, erreur côté serveur
    if($fileError == 6 || $fileError == 7 || $fileError == 8){
        $errors[] = 'Problème serveur';
    }

    // Si pas d'erreurs
    if(!isset($errors)){

        // On récupère le vrai Type MIME du fichier (non pas par son extension !)
        $trueMimeType = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $_FILES['myImage']['tmp_name']);

        // Liste des types mimes autorisés
        $mimeTypeValides = array('image/png', 'image/jpeg', 'image/gif');

        // Si le type MIME est dans la liste des types autorisé, on continue, sinon erreur
        if(in_array($trueMimeType, $mimeTypeValides)){

            // On retrouve l'extension du fichier finale via son type MIME
            if($trueMimeType == 'image/png'){
                $newExtFile = 'png';
            } elseif($trueMimeType == 'image/jpeg'){
                $newExtFile = 'jpg';
            } elseif($trueMimeType == 'image/gif'){
                $newExtFile = 'gif';
            }

            // Tant que le nom du fichier créé existe, on en recrée un autre.
            do{
                $newFileName = md5(rand().time().uniqid());
            } while(file_exists('images/'.$newFileName . '.' . $newExtFile));

            // Sauvegarde du fichier dans un sous dossier images.
            move_uploaded_file($_FILES['myImage']['tmp_name'], 'images/'.$newFileName . '.' . $newExtFile);

            // message de succès
            $success = 'Image envoyée !';
        } else {
            $errors[] = 'Fichier interdit';
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
    <title>Upload fichier</title>
</head>
<body>
<?php
if(!isset($success)){
?>
    <form action="index.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
        <input type="file" name="myImage">
        <input type="submit">
    </form>
<?php
} else {
    echo '<p style="color:green;">' . $success . '</p>';
}

if(isset($errors)){
    foreach($errors as $error){
        echo '<p style="color:red;">' . $error . '</p>';
    }
}

?>
</body>
</html>