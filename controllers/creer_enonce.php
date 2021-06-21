<?php
session_start();
model("creation");

if (isset($_POST['submitEnonce']) && !empty($_POST['submitEnonce'])) {
    // Formulaire enoncé validé !

    $contenuEnonce = $_POST['contenuEnonce'];
    $contenuEnonce = str_replace("'", "\'", $contenuEnonce);

    $res = getEnonceByContent($contenuEnonce);
    if ($res) {
        if (mysqli_num_rows($res) == 0) {
            if (strlen($contenuEnonce) <= 10000) {
                $res = createEnonce($contenuEnonce);
                if ($res) {
                    $_POST['success'] = "Votre enoncé a bien été ajouté dans la base de données !";
                } else {
                    $_POST['error'] = "Erreur lors de l'exécution de la requête !";
                }
            } else {
                $_POST['error'] = "Enoncé trop grand ! (max: 10000 caractères)";
            }
        } else {
            $_POST['error'] = "Cet enoncé existe déjà dans la base de données !";
        }
    } else {
        $_POST['error'] = "Erreur lors de l'exécution de la requête !";
    }
}

view("creer_enonce");