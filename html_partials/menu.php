<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="./">GRODENT Alexandre 21O5</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <!--<li class="nav-item">
                    <a class="nav-link" href="./generer_enonce">Générer un énoncé</a>
                </li>-->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCreation" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Création
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownCreation">
                        <a class="dropdown-item" href="/<?= getBaseDirectory() ?>/creer_enonce">Créer énoncé</a>
                        <a class="dropdown-item" href="/<?= getBaseDirectory() ?>/creer_champ">Créer champ</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownLists" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Listes
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownLists">
                        <a class="dropdown-item" href="/<?= getBaseDirectory() ?>/liste_enonces">Liste énoncés</a>
                        <a class="dropdown-item" href="/<?= getBaseDirectory() ?>/liste_champs">Liste champs</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/<?= getBaseDirectory() ?>/liste_enonces_generes">Liste énoncés générés</a>
                        <a class="dropdown-item" href="/<?= getBaseDirectory() ?>/liste_enonces_generes">Liste images hébergés</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>