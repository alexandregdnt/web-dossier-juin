<?php partial("header"); ?>

    <header class="bg-primary text-white">
        <div class="container text-center">
            <h1>Génération d'énoncés</h1>
        </div>
    </header>

    <section class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <?php
                    if (isset($_POST['error']) && !empty($_POST['error'])) {
                        printError($_POST['error']);
                    } elseif (isset($_POST['success']) && !empty($_POST['success'])) {
                        printSuccess($_POST['success']);
                    } elseif (isset($_POST['warning']) && !empty($_POST['warning'])) {
                        printWarning($_POST['warning']);
                    }
                    ?>

                    <h4 class="text-center mb-4">Enoncé</h4>

                    <?php if (isset($_POST['genererEnonce']) && !empty($_POST['genererEnonce']) && (!isset($_POST['error']) || empty($_POST['error'])) && (isset($_POST['generatedFileId']) && !empty($_POST['generatedFileId']))) { ?>
                        <div class="container">
                            <div class="row mb-1">
                                <p>Identifiant de l'énoncé généré: <span class="font-weight-bold"><?= $_POST['generatedFileId'] ?></span></p>
                            </div>
                            <div class="row mb-4">
                                <a class="col-4 mx-auto btn btn-success" href="./generated/<?= $_POST['generatedFileId'] ?>.html" download="Enoncé généré.html">Télécharger ici</a>
                                <a class="col-4 mx-auto btn btn-secondary" href="./generated/<?= $_POST['generatedFileId'] ?>.html" target="_blank">Visualiser ici</a>
                            </div>
                        </div>
                    <?php } ?>

                    <form action="#" method="POST">
                        <label class="mb-3" for="genererEnonce">En cliquant sur ce bouton, vous aller générer un énoncé aléatoire.</label><br>
                        <input class="btn btn-primary" type="submit" id="genererEnonce" name="genererEnonce" value="Générer">
                    </form>
                </div>
            </div>
        </div>
    </section>

<?php partial("footer"); ?>