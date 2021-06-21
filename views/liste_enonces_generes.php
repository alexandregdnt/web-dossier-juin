<?php partial("header"); ?>

    <header class="bg-primary text-white">
        <div class="container text-center">
            <h1>Liste des énoncés générés</h1>
        </div>
    </header>

    <section class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 mx-auto">
                    <?php
                    if (isset($_POST['error']) && !empty($_POST['error'])) {
                        printError($_POST['error']);
                    } elseif (isset($_POST['success']) && !empty($_POST['success'])) {
                        printSuccess($_POST['success']);
                    } elseif (isset($_POST['warning']) && !empty($_POST['warning'])) {
                        printWarning($_POST['warning']);
                    }
                    ?>

                    <?php if (isset($_GET['id']) && !empty($_GET['id']) && (!isset($_POST['error']) || empty($_POST['error'])) && (isset($_GET['action']) && !empty($_GET['action'])) && $_GET['action'] === "rename") { ?>
                        <form action="/liste_enonces_generes" method="POST">
                            <h3 class="text-center mb-4">Renommer un énoncé généré</h3>
                            <div class="container mb-5">
                                <div class="row mb-3">
                                    <div class="col-12 col-md-6 mb-3 mb-md-0">
                                        <label for="oldNameDisplay">Ancien nom</label>
                                        <input class="form-control" type="text" id="oldNameDisplay" name="oldNameDisplay" value="<?= $_GET['id'] ?>" required disabled>
                                        <input class="form-control" type="hidden" id="oldName" name="oldName" value="<?= $_GET['id'] ?>" required>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="newName">Nouveau nom</label>
                                        <input class="form-control" type="text" id="newName" name="newName" value="" placeholder="<?= $_GET['id'] ?>" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <input class="col-4 mx-auto btn btn-primary" type="submit" name="enonceEditSubmit" value="Sauvegarder">
                                    <a class="col-4 mx-auto btn btn-danger" href="/liste_enonces_generes">Annuler</a>
                                </div>
                            </div>
                        </form>
                        <hr>
                    <?php } ?>

                    <div class="container">
                        <h3 class="text-center mb-4">Liste des énoncés déjà générés</h3>
                        <div class="row">
                            <?php
                            $directory = "../public/generated/";
                            $scanned_directory = array_diff(scandir($directory), array('..', '.'));

                            // var_dump($scanned_directory);
                            if (count($scanned_directory) > 0) {
                                foreach ($scanned_directory as $key => $value) {
                                    $value = preg_replace("/\.html/", "", $value, 1);
                                    ?>
                                    <div class="col-12 mb-3 p-3 enonce">
                                        <h4><?= htmlspecialchars($value) ?></h4>
                                        <div class="mt-3">
                                            <a class="btn btn-success" href="/generated/<?= urlencode($value) ?>.html" download="Enoncé généré.html">Télécharger ici</a>
                                            <a class="btn btn-secondary" href="/generated/<?= urlencode($value) ?>.html" target="_blank">Visualiser ici</a>
                                            <a class="btn btn-danger" href="/liste_enonces_generes/<?= urlencode($value) ?>/delete">Supprimer</a>
                                            <a class="btn btn-warning" href="/liste_enonces_generes/<?= urlencode($value) ?>/rename">Renommer</a>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                echo '<div class="col-12 mx-auto">';
                                printError("Aucun énoncés disponible dans la base de données !");
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php partial("footer"); ?>