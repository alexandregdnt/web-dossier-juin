<?php
function partial ($name) {
    require_once(__DIR__ . "/html_partials/$name.php");
}
function controller ($name) {
    require_once(__DIR__ . "/controllers/$name.php");
}
function model ($name) {
    require_once(__DIR__ . "/models/$name.php");
}
function view ($name) {
    require_once(__DIR__ . "/views/$name.php");
}
function redirect($page) {
    header('Location: ' .$page);
    die();
}

function dbConnect() {
    $hostname = "localhost";
    $database = "dossier_web";
    $user = "root";
    $password = "root";
    $port = 8889;

    $mysqli = new mysqli($hostname, $user, $password, $database, $port);
    if ($mysqli->connect_errno) {
        die("Erreur : Échec lors de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error . "\n" . $mysqli->host_info . "\n");
    }
    return $mysqli;
}

function printError($sMsg) {
    echo '<div class="alert alert-danger"><strong>Erreur : </strong>'.$sMsg.'</div>';
}
function printSuccess($sMsg) {
    echo '<div class="alert alert-success"><strong>Succès : </strong>'.$sMsg.'</div>';
}
function printWarning($sMsg) {
    echo '<div class="alert alert-warning"><strong>Attention : </strong>'.$sMsg.'</div>';
}