<?php
model("generer_enonce");

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $enonceId = htmlspecialchars($_GET['id']);

            $res = getEnonceById($enonceId);
            if ($res) {
                if (mysqli_num_rows($res) > 0) {
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
                                    $selectedOptionId = rand(0, $availableOptions-1);
                                    $selectedOption = $options[$selectedOptionId];
                                } elseif ($row["typechamp"] === "image") {
                                    $availableOptions = count($options);
                                    $selectedOptionId = rand(0, $availableOptions-1);
                                    $selectedOption = $options[$selectedOptionId];

                                    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
                                        $url = "https://";
                                    } else {
                                        $url = "http://";
                                    }
                                    // Append the host(domain name, ip) to the URL.
                                    $url.= $_SERVER['HTTP_HOST'];
                                    $url.= "/". getBaseDirectory();
                                    $url.= "/assets/uploads/img/";
                                    $url.= $selectedOption;

                                    if (imgUrlExist($url)) {
                                        $selectedOption = "<img alt='Image aléatoire' src='". $url ."'>";
                                    } else {
                                        $selectedOption = "[img]Image indisponible (". $selectedOption .")[/img]";
                                    }
                                } else {
                                    $selectedOption = $value[0];
                                }

                                $content = implode($selectedOption, explode($value[0], $content, 2));
                                //$content = str_replace($value[0], $selectedOption, $content);
                            } else {
                                $_POST['warning'] = "Le champ (". $value[1] .") mentionné dans cet énoncé n'est pas présent dans la base de données !";
                            }
                        } else {
                            $_POST['error'] = "Erreur lors de l'exécution de la requête !";
                        }
                    }
                } else {
                    $_POST['error'] = "Cet énoncé n'existe pas !";
                }
            } else {
                $_POST['error'] = "Erreur lors de l'exécution de la requête !";
            }

    if (!isset($content) || empty($content)) {
        $content = "";
    }

    $style = file_get_contents("./assets/css/generated.css");
    $htmlCode = '
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Enoncé généré par Alexandre GRODENT</title>
    
    <!-- Stylesheets -->
    <style>'. $style .'</style>
</head>
<body>
<div class="description">
    <h1>Enoncé généré</h1>
    <p>Bonjour et bienvenue sur un énoncé généré par le site web d\'<a href="https://alexgr.be" target="_blank">Alexandre Grodent</a>.</p>
</div>

<div class="enonce">'. $content .'
</div>
</body>
</html>
    ';

    $generatedFileId = getGeneratedFileId();
    $_POST['generatedFileId'] = $generatedFileId;
    if ($generatedFileId == -1) {
        $_POST['error'] = "Le nombre d'intevalle d'id possible est trop petit !";
    }

    if (!isset($_POST['error']) || empty($_POST['error'])) {
        file_put_contents("generated/$generatedFileId.html", $htmlCode);
        // redirect("generated/");
    }
}

view("generer_enonce");