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

    <section id="createChamp" class="mb-4">
        <div class="container">
            <div class="row mb-4">
                <div class="col-lg-8 mx-auto">
                    <form action="#createChamp" method="POST">
                        <h4 class="text-center mb-4">Etape 2. Champs</h4>
                        <?php
                        if (isset($_POST['submitChamp']) && !empty($_POST['submitChamp'])) {
                            if (isset($_POST['error']) && !empty($_POST['error'])) {
                                printError($_POST['error']);
                            } elseif (isset($_POST['success']) && !empty($_POST['success'])) {
                                printSuccess($_POST['success']);
                            } elseif (isset($_POST['warning']) && !empty($_POST['warning'])) {
                                printWarning($_POST['warning']);
                            }
                        }
                        ?>

                        <?php
                        if ((isset($_POST['submitChamp']) && !empty($_POST['submitChamp'])) &&
                            (isset($_SESSION['nomChamp']) && !empty($_SESSION['nomChamp'])) &&
                            (isset($_SESSION['typeChamp']) && !empty($_SESSION['typeChamp']))) {
                            if ($_SESSION['typeChamp'] === "number") { ?>
                                <div class="row mb-3">
                                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                                        <input class="form-control" type="number" name="nombreBorneInferieure" placeholder="Borne inférieure" value="" required>
                                    </div>
                                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                                        <input class="form-control" type="number" name="nombreBorneSupperieure" placeholder="Borne supérieure" value="" required>
                                    </div>
                                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                                        <input class="form-control" type="number" name="nombrePas" placeholder="Pas" value="" min="0.00" step="0.01" required>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <textarea class="form-control" id="paramsChamp" name="paramsChamp" placeholder="Paramètres du champ (Veuillez les séparer par un point vigule suivi d'un espace '; ')" value="" required></textarea>
                                    </div>
                                </div>
                            <?php }
                        } else { ?>
                            <label for="nomChamp">Veuillez renseigner le nom du champ <span class="font-weight-bold">sans</span> les <code>##</code>.</label>
                            <div class="row mb-3">
                                <div class="col-12 col-md-6 mb-3 mb-md-0">
                                    <input class="form-control" type="text" id="nomChamp" name="nomChamp" placeholder="Nom du champ" value="" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <select class="form-control" id="typeChamp" name="typeChamp" required>
                                        <option value="" selected disabled>---- Type de champ ----</option>
                                        <option value="number">Nombre</option>
                                        <option value="text">Texte</option>
                                        <option value="image">Image</option>
                                    </select>
                                </div>
                            </div>
                        <?php } ?>

                        <input class="btn btn-primary" type="submit" name="submitChamp" value="Envoyer">
                    </form>
                </div>
            </div>
            <div class="row float-right mt-3 mb-5">
                <div class="col-12 text-center">
                    <a href="./generer_enonce" class="btn btn-primary">Suivant -> Générer un énoncé</a>
                </div>
            </div>
        </div>
    </section>

<?php partial("footer"); ?>