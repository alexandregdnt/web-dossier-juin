<?php
// model('ajout_image');

if (isset($_POST['submitAddFile']) && isset($_FILES["fileToUpload"]) && (isset($_POST['fileName']) && !empty($_POST['fileName']))) {

    $target_dir = "../public/assets/uploads/img/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $newFileName = $_POST['fileName'] . "." . $imageFileType;

    preg_match_all("/\W/", $_POST['fileName'], $matches);
    $matches = $matches[0];

    if (count($matches) <= 0) {
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            // echo "File is an image - " . $check["mime"] . ".";
            // Check if file already exists
            if (!file_exists($target_file)) {
                // Check file size
                if ($_FILES["fileToUpload"]["size"] <= 500000) {
                    // Allow certain file formats
                    if($imageFileType === "jpg" || $imageFileType === "png" || $imageFileType === "jpeg" || $imageFileType === "gif" ) {
                        // Déplace le fichier temporaire au bon endroit
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                            if (rename($target_file, $target_dir. $newFileName)) {
                                $_POST['success'] = "Votre fichier a bien été tranférer sur le site !";
                                // echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                            } else {
                                $_POST['warning'] = "Votre fichier a bien été tranférer sur le site mais pas renommé !";
                            }
                        } else {
                            $_POST['error'] = "Erreur lors du transfert de votre fichier !";
                        }
                    } else {
                        $_POST['error'] = "Désolé, uniquement les fichiers de type JPG, JPEG, PNG & GIF sont acceptés !";
                    }
                } else {
                    $_POST['error'] = "Votre fichier est trop grand !";
                }
            } else {
                $_POST['error'] = "Un fichier avec le même nom existe déjà !";
            }
        } else {
            $_POST['error'] = "Ce fichier n'est pas une image !";
        }
    } else {
        $_POST['error'] = "Le nom du fichier mentionné ne peut comprendre que des lettre, des chiffres et _ !";
    }
}

view('ajout_image');