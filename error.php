<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Error</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">
    <style>
        *, body {
            -webkit-font-smoothing: antialiased;
            text-rendering: optimizeLegibility;
            -moz-osx-font-smoothing: grayscale;
        }
        * {
            line-height: 1.2;
            margin: 0;
        }

        html {
            color: #888;
            display: table;
            font-family: 'Nunito Sans', sans-serif;
            height: 100%;
            text-align: center;
            width: 100%;
        }

        .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
            font-family: 'Nunito Sans', sans-serif;
        }

        body {
            display: table-cell;
            vertical-align: middle;
            margin: 2em auto;
        }

        h1 {
            color: #ef4153;
            text-shadow: rgba(235, 82, 93, 0.3) 5px 1px, rgba(235, 82, 93, 0.2) 10px 3px;
            font-size: 150px;
            font-weight: 800;
            margin-bottom: 10px;
            letter-spacing: 2px;
        }
        h4 {
            color: #4a5361;
            text-transform: capitalize;
            font-size: 28px;
        }

        p {
            margin: 0 auto;
            max-width: 790px;
            margin-top: 20px;
            color: #666 ;
            margin-bottom: 10px;
            font-size: 15px;
            line-height: 20px;
        }
        a {
            display: inline-block;
            padding: 8px 15px;
            background-color: #ef4153;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 20px;
        }

        @media only screen and (max-width: 280px) {

            body, p {
                width: 95%;
            }

            h1 {
                font-size: 1.5em;
                margin: 0 0 0.3em;
            }

        }

    </style>
</head>
<body>
<?php
switch($_GET['id'])
{
   case '400':
   echo '<h1>400</h1><h4>Échec de l\'analyse HTTP.</h4><p>On dirait que vous avez peut-être pris un mauvais tournant. Ne t\'inquiète pas ... ça arrive aux meilleurs d\'entre nous. Voici un petit conseil qui pourrait vous aider à vous remettre sur la bonne voie.</p><a href="/">Retourner à l\'Accueil</a>';
   break;
   case '401':
   echo '<h1>401</h1><h4>Le pseudo ou le mot de passe n\'est pas correct !</h4><p>On dirait que vous avez peut-être pris un mauvais tournant. Ne t\'inquiète pas ... ça arrive aux meilleurs d\'entre nous. Voici un petit conseil qui pourrait vous aider à vous remettre sur la bonne voie.</p><a href="/">Retourner à l\'Accueil</a>';
   break;
   case '402':
   echo '<h1>402</h1><h4>Le client doit reformuler sa demande avec les bonnes données de paiement.</h4><p>On dirait que vous avez peut-être pris un mauvais tournant. Ne t\'inquiète pas ... ça arrive aux meilleurs d\'entre nous. Voici un petit conseil qui pourrait vous aider à vous remettre sur la bonne voie.</p><a href="/">Retourner à l\'Accueil</a>';
   break;
   case '403':
   echo '<h1>403</h1><h4>Requête interdite !</h4><p>On dirait que vous avez peut-être pris un mauvais tournant. Ne t\'inquiète pas ... ça arrive aux meilleurs d\'entre nous. Voici un petit conseil qui pourrait vous aider à vous remettre sur la bonne voie.</p><a href="/">Retourner à l\'Accueil</a>';
   break;
   case '404':
   echo '<h1>404</h1><h4>La page n\'existe pas ou plus !</h4><p>On dirait que vous avez peut-être pris un mauvais tournant. Ne t\'inquiète pas ... ça arrive aux meilleurs d\'entre nous. Voici un petit conseil qui pourrait vous aider à vous remettre sur la bonne voie.</p><a href="/">Retourner à l\'Accueil</a>';
   break;
   case '405':
   echo '<h1>405</h1><h4>Méthode non autorisée.</h4><p>On dirait que vous avez peut-être pris un mauvais tournant. Ne t\'inquiète pas ... ça arrive aux meilleurs d\'entre nous. Voici un petit conseil qui pourrait vous aider à vous remettre sur la bonne voie.</p><a href="/">Retourner à l\'Accueil</a>';
   break;
   case '500':
   echo '<h1>500</h1><h4>Erreur interne au serveur ou serveur saturé.</h4><p>On dirait que vous avez peut-être pris un mauvais tournant. Ne t\'inquiète pas ... ça arrive aux meilleurs d\'entre nous. Voici un petit conseil qui pourrait vous aider à vous remettre sur la bonne voie.</p><a href="/">Retourner à l\'Accueil</a>';
   break;
   case '501':
   echo '<h1>501</h1><h4>Le serveur ne supporte pas le service demandé.</h4><p>On dirait que vous avez peut-être pris un mauvais tournant. Ne t\'inquiète pas ... ça arrive aux meilleurs d\'entre nous. Voici un petit conseil qui pourrait vous aider à vous remettre sur la bonne voie.</p><a href="/">Retourner à l\'Accueil</a>';
   break;
   case '502':
   echo '<h1>502</h1><h4>Mauvaise passerelle.</h4><p>On dirait que vous avez peut-être pris un mauvais tournant. Ne t\'inquiète pas ... ça arrive aux meilleurs d\'entre nous. Voici un petit conseil qui pourrait vous aider à vous remettre sur la bonne voie.</p><a href="/">Retourner à l\'Accueil</a>';
   break;
   case '503':
   echo '<h1>503</h1><h4>Service indisponible.</h4><p>On dirait que vous avez peut-être pris un mauvais tournant. Ne t\'inquiète pas ... ça arrive aux meilleurs d\'entre nous. Voici un petit conseil qui pourrait vous aider à vous remettre sur la bonne voie.</p><a href="/">Retourner à l\'Accueil</a>';
   break;
   case '504':
   echo '<h1>504</h1><h4>Trop de temps à la réponse.</h4><p>On dirait que vous avez peut-être pris un mauvais tournant. Ne t\'inquiète pas ... ça arrive aux meilleurs d\'entre nous. Voici un petit conseil qui pourrait vous aider à vous remettre sur la bonne voie.</p><a href="/">Retourner à l\'Accueil</a>';
   break;
   case '505':
   echo '<h1>505</h1><h4>Version HTTP non supportée.</h4><p>On dirait que vous avez peut-être pris un mauvais tournant. Ne t\'inquiète pas ... ça arrive aux meilleurs d\'entre nous. Voici un petit conseil qui pourrait vous aider à vous remettre sur la bonne voie.</p><a href="/">Retourner à l\'Accueil</a>';
   break;
   default:
   echo 'Erreur !';
}
?>
</body>
</html>
<!-- IE needs 512+ bytes: http://blogs.msdn.com/b/ieinternals/archive/2010/08/19/http-error-pages-in-internet-explorer.aspx -->
