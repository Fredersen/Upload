<?php

$file ="";
if($_SERVER['REQUEST_METHOD'] === "POST"){ 
    $uploadDir = './';
    $uploadFile = basename($_FILES['homerPicture']['name']);
    $extension = pathinfo($_FILES['homerPicture']['name'], PATHINFO_EXTENSION);
    $authorizedExtensions = ['jpg','png','gif', 'webp'];
    $maxFileSize = 1000000;
    

    if( (!in_array($extension, $authorizedExtensions))){
        $errors[] = 'Veuillez sélectionner une image de type jpg ou png ou gif ou webp !';
    }

    if( file_exists($_FILES['homerPicture']['tmp_name']) && filesize($_FILES['homerPicture']['tmp_name']) > $maxFileSize)
    {
    $errors[] = "Votre fichier doit faire moins de 1MO !";
    }

    $uniqName = uniqid('',true);
    $file = $uniqName . "." . $extension;

    move_uploaded_file($_FILES['homerPicture']['tmp_name'], './' . $file);
    header('location:/form.php?name=' . $file);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
    <label for="homerPicture">Upload an picture of Homer</label>    
    <input type="file" name="homerPicture" id="imageUpload" />
    <button name="send">Send</button>
</form>
<img src= <?php echo './'.$_GET["name"]; ?>> 
</body>
</html>
