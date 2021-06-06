<?php
model("listes");

if ((isset($_GET['name']) && !empty($_GET['name'])) && (isset($_GET['action']) && !empty($_GET['action']))) {
    $nomChamp = htmlspecialchars($_GET['name']);

    $res = getChamp($nomChamp);
    if ($res) {
        if (mysqli_num_rows($res) > 0) {
            if ($_GET['action'] == "delete") {
                $res = deleteChamp($nomChamp);
                if ($res) {
                    $_POST['success'] = "L'énoncé a bien été supprimé !";
                } else {
                    $_POST['error'] = "Erreur lors de l'exécution de la requête !";
                }

            } elseif ($_GET['action'] == "edit") {
                $row = mysqli_fetch_assoc($res);

                $content = $row["contenu"];
                $content = str_replace("<script>", htmlspecialchars("<script>"), $content);
                $content = str_replace("</script>", htmlspecialchars("</script>"), $content);

                $_POST['enonceEditId'] = $enonceId;
                $_POST['enonceEditContent'] = $content;
            } else {
                $_POST['error'] = "Aucune action correspondante !";
            }
        } else {
            $_POST['error'] = "Cet énoncé n'existe pas !";
        }
    } else {
        $_POST['error'] = "Erreur lors de l'exécution de la requête !";
    }
}

if (isset($_POST['enonceEditSubmit']) && (isset($_POST['enonceEditContent']) && !empty($_POST['enonceEditContent'])) && (isset($_POST['enonceEditId']) && !empty($_POST['enonceEditId']))) {
    $enonceId = htmlspecialchars($_POST['enonceEditId']);

    $res = getEnonceById($enonceId);
    if ($res) {
        if (mysqli_num_rows($res) > 0) {
            $nouveauContenuEnonce = $_POST['enonceEditContent'];
            $nouveauContenuEnonce = str_replace("'", "\'", $nouveauContenuEnonce);

            $res = updateEnonceById($enonceId, $nouveauContenuEnonce);
            if ($res) {
                $_POST['success'] = "Enoncé modifié avec succès !";
            } else {
                $_POST['error'] = "Erreur lors de l'exécution de la requête !";
            }
        } else {
            $_POST['error'] = "Cet énoncé n'existe pas !";
        }
    } else {
        $_POST['error'] = "Erreur lors de l'exécution de la requête !";
    }
}

view("liste_champs");