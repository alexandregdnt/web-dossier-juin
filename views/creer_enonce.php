<?php partial("header"); ?>

    <header class="bg-primary text-white">
        <div class="container text-center">
            <h1>Création d'énoncés</h1>
        </div>
    </header>

    <section id="createEnonce" class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <form action="#createEnonce" method="POST">
                        <h4 class="text-center mb-4">Etape 1. Enoncé</h4>
                        <?php
                        if (isset($_POST['submitEnonce']) && !empty($_POST['submitEnonce'])) {
                            if (isset($_POST['error']) && !empty($_POST['error'])) {
                                printError($_POST['error']);
                            } elseif (isset($_POST['success']) && !empty($_POST['success'])) {
                                printSuccess($_POST['success']);
                            } elseif (isset($_POST['warning']) && !empty($_POST['warning'])) {
                                printWarning($_POST['warning']);
                            }
                        }
                        ?>

                        <p>
                            Pour insérer des données générées aléatoirement au seing de votre énoncé, <br>
                            veuillez mettre le nom du champ entre <code>##</code>. <br>
                            <span class="font-weight-bold">Exemple:</span> <code>##temperature##</code>
                        </p>

                        <div class="mb-3">
                            <input type="hidden" id="contenuEnonce" name="contenuEnonce" value="<?= (isset($_POST['contenuEnonce']) && !empty($_POST['contenuEnonce'])) ? htmlspecialchars($_POST['contenuEnonce']) : "" ?>">
                            <trix-editor input="contenuEnonce" class="trix-content"></trix-editor>
                        </div>

                        <input class="btn btn-primary" type="submit" name="submitEnonce" value="Envoyer">
                    </form>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row float-right">
            <div class="col-12">
                <a href="./creer_champ" class="btn btn-primary">Suivant -> Créer un champ</a>
            </div>
        </div>
    </div>

<?php partial("footer"); ?>