<?php partial("header"); ?>

<header class="bg-primary text-white">
    <div class="container text-center">
        <h1>Bienvenue dans votre gestionnaire d'énoncés</h1>
        <p class="lead">Page d'accueil</p>
    </div>
</header>

<section>
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 mx-auto">
                <h2>Explication</h2>
                <p class="lead">
                    Ce site web vous permet de générer des énoncés comportant des champs aléatoires. <br>
                    Exemple: <code>##nombre##</code> est remplacé par un nombre aléatoire compris entre 2 valeurs avec un certain pas.
                    <i>Ces paramètres devront être défini lors de la création d'un champ.</i> <br>
                    Un champ peut être défini en temps que nombre, texte ou image.
                </p>

                <div class="container">
                    <div class="row mb-5">
                        <div class="col-4 text-center">
                            <p><b>Etape 1</b></p>
                            <a href="/creer_enonce" class="btn btn-primary">Créer un énoncé</a>
                        </div>
                        <div class="col-4 text-center">
                            <p><b>Etape 2</b></p>
                            <a href="/creer_champ" class="btn btn-primary">Créer un champ</a>
                        </div>
                        <div class="col-4 text-center">
                            <p><b>Etape 3</b></p>
                            <a href="/liste_enonces" class="btn btn-primary">Générer un énoncé</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">

        </div>
    </div>
</section>

<?php partial("footer"); ?>