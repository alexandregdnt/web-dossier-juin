<?php
model("listes");

if ((isset($_GET['id']) && !empty($_GET['id'])) && (isset($_GET['action']) && !empty($_GET['action']))) {
    $enonceId = htmlspecialchars($_GET['id']);

    $res = getEnonceById($enonceId);
    if ($res) {
        if (mysqli_num_rows($res) > 0) {
            if ($_GET['action'] == "generate") {
                        $row = mysqli_fetch_assoc($res);

                        $content = $row["contenu"];
                        $content = str_replace("<script>", htmlspecialchars("<script>"), $content);
                        $content = str_replace("</script>", htmlspecialchars("</script>"), $content);

                        preg_match_all("/##(.+)##/U", $content, $matches, PREG_SET_ORDER);

                        foreach ($matches as $key => $value) {
                            $res = getChamp($value[1]);

                            if ($res) {
                                if (mysqli_num_rows($res) > 0) {
                                    $row = mysqli_fetch_assoc($res);
                                    $options = unserialize($row["parametres"]);

                                    if ($row["typechamp"] === "number") {
                                        $nombreBorneInferieure = $options[0];
                                        $nombreBorneSupperieure = $options[1];
                                        $nombrePas = $options[2];

                                        $selectedOption = randFloat($nombreBorneInferieure, $nombreBorneSupperieure, $nombrePas);
                                    } elseif ($row["typechamp"] === "text") {
                                        $availableOptions = count($options);
                                        $selectedOptionId = rand(0, $availableOptions - 1);
                                        $selectedOption = $options[$selectedOptionId];
                                    } elseif ($row["typechamp"] === "image") {
                                        $availableOptions = count($options);
                                        $selectedOptionId = rand(0, $availableOptions - 1);
                                        $selectedOption = $options[$selectedOptionId];

                                        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
                                            $url = "https://";
                                        } else {
                                            $url = "http://";
                                        }
                                        // Append the host(domain name, ip) to the URL.
                                        $url .= $_SERVER['HTTP_HOST'];
                                        $url .= "/assets/uploads/img/";
                                        $url .= $selectedOption;

                                        $imgDirectory = "../public/assets/uploads/img/";
                                        $check = getimagesize($imgDirectory . basename($selectedOption));
                                        if ($check !== false) {
                                            $selectedOption = "<img alt='Image aléatoire' src='" . $url . "'>";
                                        } else {
                                            $selectedOption = "[img]Image indisponible (" . $selectedOption . ")[/img]";
                                        }
                                    } elseif ($row["typechamp"] === "date") {
                                        $dateBorneInferieure = strtotime($options[0]);
                                        $dateBorneSupperieure = strtotime($options[1]);
                                        $selectedTimestamp = rand($dateBorneInferieure, $dateBorneSupperieure);

                                        $selectedOption = date("d/m/Y", $selectedTimestamp);
                                    } else {
                                        $selectedOption = $value[0];
                                    }

                                    $content = implode($selectedOption, explode($value[0], $content, 2));
                                    //$content = str_replace($value[0], $selectedOption, $content);
                                } else {
                                    $_POST['warning'] = "Le champ (" . $value[1] . ") mentionné dans cet énoncé n'est pas présent dans la base de données !";
                                }
                            } else {
                                $_POST['error'] = "Erreur lors de l'exécution de la requête !";
                            }
                        }

                if (!isset($content) || empty($content)) {
                    $content = "";
                }

                if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
                    $url = "https://";
                } else {
                    $url = "http://";
                }
                // Append the host(domain name, ip) to the URL.
                $url .= $_SERVER['HTTP_HOST'];

                $generatedFileId = getGeneratedFileId();
                $_POST['generatedFileId'] = $generatedFileId;
                if ($generatedFileId == -1) {
                    $_POST['error'] = "Le nombre d'intevalle d'id possible est trop petit !";
                }

                $style = file_get_contents("../public/assets/css/generated.css");
                $htmlCode = '
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Enoncé généré par RandGen</title>
    
    <!-- Stylesheets -->
    <style>' . $style . '</style>
</head>
<body>
<div class="description">
    <h1>Enoncé généré</h1>
    <p>Bonjour et bienvenue sur un énoncé généré par le site web <a href="' . $url . '" target="_blank">RandGen</a>.</p>
</div>

<div class="enonce">' . $content . '
</div>
</body>
<footer>
<p>Identifiant de l\'énoncé: ' . $generatedFileId . '</p>
</footer>
</html>
    ';

                if (!isset($_POST['error']) || empty($_POST['error'])) {
                    file_put_contents("../public/generated/$generatedFileId.html", $htmlCode);
                    // redirect("generated/$generatedFileId.html");
                }


            } elseif ($_GET['action'] == "delete") {
                $res = deleteEnonceById($enonceId);
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

view("liste_enonces");