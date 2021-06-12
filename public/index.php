<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('../fct.inc.php');

switch ((isset($_GET['page'])) ? $_GET['page'] : "") {
    case "creer_enonce":
        controller("creer_enonce");
        break;
    case "creer_champ":
        controller("creer_champ");
        break;
    case "liste_enonces":
        controller("liste_enonces");
        break;
    case "liste_champs":
        controller("liste_champs");
        break;
    case "liste_enonces_generes":
        controller("liste_enonces_generes");
        break;
    case "liste_images":
        controller("liste_images");
        break;
    case "ajout_image":
        controller("ajout_image");
        break;
    default:
        controller("index");
        break;
}