<?php
session_start();
model("creer_enonce");

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

if (isset($_POST['submitChamp']) && !empty($_POST['submitChamp'])) {
    // Formulaire champs validé !

    if (isset($_POST['nomChamp']) && !empty($_POST['nomChamp']) && isset($_POST['typeChamp']) && !empty($_POST['typeChamp'])) {
        $_SESSION['nomChamp'] = strtolower($_POST['nomChamp']);
        $_SESSION['typeChamp'] = strtolower($_POST['typeChamp']);
    }
    $nomChamp = $_SESSION['nomChamp'];
    $typeChamp = $_SESSION['typeChamp'];

    $nomChamp = str_replace("##", "", $nomChamp);
    $nomChamp = str_replace(" ", "_", $nomChamp);

    if (strlen($nomChamp) <= 50) {
        $res = getChamp($nomChamp);
        if ($res) {
        if (mysqli_num_rows($res) == 0) {
                if ($typeChamp === "number" || $typeChamp === "text" || $typeChamp === "image") {
                if ($typeChamp === "number") {
                    if (isset($_POST['nombreBorneInferieure']) && !empty($_POST['nombreBorneInferieure']) && isset($_POST['nombreBorneSupperieure']) && !empty($_POST['nombreBorneSupperieure']) && isset($_POST['nombrePas']) && !empty($_POST['nombrePas'])) {
                        $nombreBorneInferieure = $_POST['nombreBorneInferieure'];
                        $nombreBorneSupperieure = $_POST['nombreBorneSupperieure'];
                        $nombrePas = $_POST['nombrePas'];

                        if ($nombreBorneInferieure < $nombreBorneSupperieure) {
                            $array = [$nombreBorneInferieure, $nombreBorneSupperieure, $nombrePas];
                            $paramsChamp = serialize($array);
                        } else {
                            $_POST['error'] = "Borne suppérieur inférieure à la borne inférieure !";
                        }
                    }
                } elseif ($typeChamp === "image") {
                    if (isset($_POST['paramsChamp']) && !empty($_POST['paramsChamp'])) {
                        $paramsChamp = $_POST['paramsChamp'];
                        $paramsChamp = str_replace("'", "\'", $paramsChamp);
                        $array = explode("; ", $paramsChamp);
                        $imgNotExist = [];

                        $validation = true;
                        foreach ($array as $key => $value) {
                            if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
                                $url = "https://";
                            } else {
                                $url = "http://";
                            }
                            // Append the host(domain name, ip) to the URL.
                            $url.= $_SERVER['HTTP_HOST'];
                            $url.= "/". getBaseDirectory();
                            $url.= "/assets/uploads/img/";
                            $url.= $value;

                            if (!imgUrlExist($url)) {
                                array_push($imgNotExist, $value);
                                $validation = false;
                            }
                        }
                        if ($validation === true) {
                            $paramsChamp = serialize($array);
                        } else {
                            if (count($imgNotExist) > 1) {
                                $_POST['error'] = implode(", ", $imgNotExist) ." ne sont pas des images valides ! (dossier images valides ./assets/img/)";
                            } else {
                                $_POST['error'] = $imgNotExist[0] ." n'est pas une image valide ! (dossier images valides ./assets/img/)";
                            }
                            unset($paramsChamp);
                        }
                    }
                } else {
                    if (isset($_POST['paramsChamp']) && !empty($_POST['paramsChamp'])) {
                        $paramsChamp = $_POST['paramsChamp'];
                        $paramsChamp = str_replace("'", "\'", $paramsChamp);
                        $array = explode("; ", $paramsChamp);
                        $paramsChamp = serialize($array);
                    }
                }
                } else {
                    $_POST['error'] = "Type de champs invalide !";
                    session_unset();
                }

                if (isset($paramsChamp) && !empty($paramsChamp)) {
                    if (strlen($paramsChamp) <= 1000) {
                        $res = createChamp($nomChamp, $typeChamp, $paramsChamp);
                        if ($res) {
                            $_POST['success'] = "Votre champ a bien été ajouté dans la base de données !";
                            session_unset();
                        } else {
                            $_POST['error'] = "Erreur lors de l'exécution de la requête !";
                        }
                    } else {
                        $_POST['error'] = "Paramètres de champ trop grand ! (max: 1000 caractères après sérialisation)";
                    }
                }
            } else {
                $_POST['error'] = "Un champ utilise déjà ce nom !";
                session_unset();
            }
        } else {
            $_POST['error'] = "Erreur lors de l'exécution de la requête !";
            session_unset();
        }

    } else {
        $_POST['error'] = "Nom de champ trop grand ! (max: 50 caractères)";
        session_unset();
    }
}

view("creer_enonce");