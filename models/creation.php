<?php
function getEnonceByContent ($content) {
    $db = dbConnect();
    return mysqli_query($db, "
        SELECT * FROM enonce 
        WHERE contenu LIKE '". $content ."';
        ");
}

function createEnonce ($content) {
    $db = dbConnect();
    return mysqli_query($db, "
        INSERT INTO enonce (contenu) 
        VALUES ('" . $content . "');
        ");
}

function getChamp ($name) {
    $db = dbConnect();
    return mysqli_query($db, "
        SELECT * FROM champ 
        WHERE nom LIKE '". $name ."';
        ");
}

function createChamp ($name, $type, $options) {
    $db = dbConnect();
    return mysqli_query($db, "
        INSERT INTO champ (nom, typechamp, parametres) 
        VALUES ('". $name ."', '". $type ."', '". $options ."');
        ");
}