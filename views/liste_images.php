<?php partial("header"); ?>

    <header class="bg-primary text-white">
        <div class="container text-center">
            <h1>Liste des images</h1>
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
                    <p>Pour ajouter des images, rendez-vous sur <a href="/<?= getBaseDirectory() ?>/ajout_image">Ajout image</a>.</p>

                    <?php if (isset($_GET['name']) && !empty($_GET['name']) && (!isset($_POST['error']) || empty($_POST['error'])) && (isset($_GET['action']) && !empty($_GET['action'])) && $_GET['action'] === "rename") { ?>
                        <form action="/<?= getBaseDirectory() ?>/liste_images" method="POST">
                            <h3 class="text-center mb-4">Renommer une image</h3>
                            <div class="container mb-5">
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <?php // printWarning("Gardez la même extension que celle d'origine (.png, .jpg, .webp, .gif) !") ?>
                                    </div>
                                    <div class="col-12 col-md-6 mb-3 mb-md-0">
                                        <label for="oldNameDisplay">Ancien nom</label>
                                        <?php
                                        $matches = preg_split("/\./", $_GET['name']);
                                        ?>
                                        <input class="form-control" type="text" id="oldNameDisplay" name="oldNameDisplay" value="<?= $matches[0] ?>" required disabled>
                                        <input class="form-control" type="hidden" name="oldName" value="<?= $matches[0] ?>" required>
                                        <input class="form-control" type="hidden" name="fileExtension" value="<?= $matches[count($matches)-1] ?>" required>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="newName">Nouveau nom</label>
                                        <input class="form-control" type="text" id="newName" name="newName" value="" placeholder="<?= $matches[0] ?>" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <input class="col-4 mx-auto btn btn-primary" type="submit" name="enonceEditSubmit" value="Sauvegarder">
                                    <a class="col-4 mx-auto btn btn-danger" href="/<?= getBaseDirectory() ?>/liste_images">Annuler</a>
                                </div>
                            </div>
                        </form>
                        <hr>
                    <?php } ?>

                    <div class="container">
                        <h3 class="text-center mb-4">Liste des images disponibles</h3>
                        <div class="row">
                            <?php
                            $directory = "./assets/uploads/img/";
                            $scanned_directory = array_diff(scandir($directory), array('..', '.'));

                            // var_dump($scanned_directory);
                            if (count($scanned_directory) > 0) {
                                foreach ($scanned_directory as $key => $value) {
                                    ?>
                                    <div class="col-12 mb-3 p-3 enonce">
                                        <h4><?= htmlspecialchars($value) ?></h4>
                                        <img class="img-enonce" src="/<?= getBaseDirectory() ?>/assets/uploads/img/<?= urlencode($value) ?>" alt="<?= $value ?>">
                                        <div class="mt-3">
                                            <a class="btn btn-danger" href="/<?= getBaseDirectory() ?>/liste_images/<?= urlencode($value) ?>/delete">Supprimer</a>
                                            <a class="btn btn-warning" href="/<?= getBaseDirectory() ?>/liste_images/<?= urlencode($value) ?>/rename">Renommer</a>
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