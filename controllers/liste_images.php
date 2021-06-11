<?php
model("listes");

if (isset($_GET['action']) && !empty($_GET['action']) && $_GET['action'] === "delete") {
    if ($_GET['action'] === "delete" || $_GET['action'] === "rename") {
        if (isset($_GET['name']) && !empty($_GET['name'])) {
            $imgName = urldecode($_GET['name']);
            $directory = "./assets/uploads/img/";
            $scanned_directory = array_diff(scandir($directory), array('..', '.'));

            // var_dump($scanned_directory);
            if (count($scanned_directory) > 0) {
                foreach ($scanned_directory as $key => $value) {
                    if ($imgName === $value) {
                        $imgKey = $key;
                        break;
                    }
                }
                if (isset($imgKey) && !empty($imgKey)) {
                    if (file_exists($directory . $scanned_directory[$imgKey])) {
                        if (unlink($directory . $scanned_directory[$imgKey])) {
                            $_POST['success'] = "Image supprimé avec succès !";
                        } else {
                            $_POST['error'] = "Erreur lors de la suppression du fichier !";
                        }
                    } else {
                        $_POST['error'] = "Cette image n'existe pas !";
                    }
                } else {
                    $_POST['error'] = "Aucune image trouvé avec ce nom !";
                }
            }
        } else {
            $_POST['error'] = "Aucun nom d'image trouvé !";
        }
    } else {
        $_POST['error'] = "Action non valable !";
    }
}

if (isset($_POST['oldName']) && !empty($_POST['oldName']) && isset($_POST['newName']) && !empty($_POST['newName'])) {
    $directory = "./assets/uploads/img/";

    if (file_exists($directory . $_POST['oldName'])) {
        if (!file_exists($directory . $_POST['newName'])) {
            if (rename($directory . $_POST['oldName'], $directory . $_POST['newName'])) {
                $_POST['success'] = "Le fichier a bien été renommé !";
            } else {
                $_POST['error'] = "Erreur lors du renommage de fichier !";
            }
        } else {
            $_POST['error'] = "Un fichier avec ce nom existe déjà !";
        }
    } else {
        $_POST['error'] = "Cette image n'existe pas !";
    }
}

view("liste_images");