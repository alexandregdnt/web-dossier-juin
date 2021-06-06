<?php
$config = file_get_contents(__DIR__ . "/config.json");
$config = json_decode($config, true);

$hostname = $config['database']['hostname'];
$port = $config['database']['port'];
$database = $config['database']['database'];
$user = $config['database']['user'];
$password = $config['database']['password'];

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
    global $hostname, $database, $user, $password, $port;
    $mysqli = mysqli_connect($hostname, $user, $password, $database, $port);
    if (mysqli_connect_errno()) {
        die("Échec lors de la connexion à MySQL : " . mysqli_connect_error());
    }
    return $mysqli;
}

function getBaseDirectory () {
    return basename(__DIR__);
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