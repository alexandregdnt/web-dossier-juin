<?php
model("listes");


if (isset($_GET['action']) && !empty($_GET['action']) && $_GET['action'] === "delete") {
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $imgName = urldecode($_GET['id']);
        $directory = "../public/generated/";
        $scanned_directory = array_diff(scandir($directory), array('..', '.'));

        // var_dump($scanned_directory);
        if (count($scanned_directory) > 0) {
            foreach ($scanned_directory as $key => $value) {
                if ($imgName === $value) {
                    $fileKey = $key;
                    break;
                }
            }
            if (isset($fileKey) && !empty($fileKey)) {
                if (file_exists($directory . $scanned_directory[$fileKey])) {
                    if (unlink($directory . $scanned_directory[$fileKey])) {
                        $_POST['success'] = "Fichier supprimé avec succès !";
                    } else {
                        $_POST['error'] = "Erreur lors de la suppression du fichier !";
                    }
                } else {
                    $_POST['error'] = "Ce fichier n'existe pas !";
                }
            } else {
                $_POST['error'] = "Aucun fichier trouvé avec ce nom !";
            }
        }
    } else {
        $_POST['error'] = "Aucun nom de fichier trouvé !";
    }
}

if (isset($_POST['oldName']) && !empty($_POST['oldName']) && isset($_POST['newName']) && !empty($_POST['newName'])) {
    $directory = "../public/generated/";

    $oldName = $_POST['oldName']. ".html";

    $newName = $_POST['newName'];
    $newName = str_replace(" ", "_", $newName);
    $newName = str_replace(".", "_", $newName);
    $newName .= ".html";

    if (file_exists($directory . $oldName)) {
        if (!file_exists($directory . $newName)) {
            if (rename($directory . $oldName, $directory . $newName)) {
                $_POST['success'] = "Le fichier a bien été renommé !";
            } else {
                $_POST['error'] = "Erreur lors du renommage de fichier !";
            }
        } else {
            $_POST['error'] = "Un fichier avec ce nom existe déjà !";
        }
    } else {
        $_POST['error'] = "Ce fichier n'existe pas !";
    }
}

view("liste_enonces_generes");