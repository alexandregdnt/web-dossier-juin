<?php
function getEnonceByContent ($content) {
    $db = dbConnect();
    return $db->query("
        SELECT * FROM enonce 
        WHERE contenu LIKE '". $content ."';
        ");
}

function createEnonce ($content) {
    $db = dbConnect();
    return $db->query("
        INSERT INTO enonce (contenu) 
        VALUES ('" . $content . "');
        ");
}

function getChamp ($name) {
    $db = dbConnect();
    return $db->query("
        SELECT * FROM champ 
        WHERE nom LIKE '". $name ."';
        ");
}

function createChamp ($name, $type, $options) {
    $db = dbConnect();
    return $db->query("
        INSERT INTO champ (nom, typechamp, parametres) 
        VALUES ('". $name ."', '". $type ."', '". $options ."');
        ");
}

function urlExist ($url) {
    // Récupération des en-têtes
    $hdrs = @get_headers($url);

    if (is_array($hdrs)) {
        // Vérification code 200 OK
        if (preg_match('/^HTTP\/\d+\.\d+\s+2\d\d\s+.*$/', $hdrs[0])) {
            return true;
        }
    }
    return false;
}

function imgUrlExist ($url) {
    $hdrs = @get_headers($url);

    if (urlExist($url)) {
        // hdrs[8] Correspond au type de contenu (html = "Content-Type: text/html; charset=UTF-8") ou (img en jpg = "Content-Type: image/jpeg")
        if (preg_match("#image/#", $hdrs[8])) {
            return true;
        }
    }
    return false;
}

function sessionDestroy () {
    session_unset();
    session_abort();
}