<?php partial("header"); ?>

    <header class="bg-primary text-white">
        <div class="container text-center">
            <h1>Liste des champs</h1>
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

                    <?php
                    if ((!isset($_POST['error']) || empty($_POST['error'])) && (isset($_GET['action']) && !empty($_GET['action'])) && $_GET['action'] == 'edit') {
                        if (isset($_POST['submitChamp']) && !empty($_POST['submitChamp'])) {
                            echo '<form action="/liste_champs" method="POST">';
                        } else {
                            echo '<form action="/liste_champs/'. $_POST['nomChamp'] .'/edit" method="POST">';
                        }
                        ?>
                            <h3 class="text-center mb-4">Modification champ</h3>
                            <div class="container mb-5">
                                <?php
                                if ((isset($_POST['submitChamp']) && !empty($_POST['submitChamp'])) &&
                                    (isset($_SESSION['nomChamp']) && !empty($_SESSION['nomChamp'])) &&
                                    (isset($_SESSION['typeChamp']) && !empty($_SESSION['typeChamp']))) {
                                    if ($_SESSION['typeChamp'] === "number") { ?>
                                        <div class="row mb-3">
                                            <div class="col-12 col-md-4 mb-3 mb-md-0">
                                                <input class="form-control" type="number" name="nombreBorneInferieure" placeholder="Borne inférieure" value="<?= $_SESSION['nombreBorneInferieure'] ?>" required>
                                            </div>
                                            <div class="col-12 col-md-4 mb-3 mb-md-0">
                                                <input class="form-control" type="number" name="nombreBorneSupperieure" placeholder="Borne supérieure" value="<?= $_SESSION['nombreBorneSupperieure'] ?>" required>
                                            </div>
                                            <div class="col-12 col-md-4 mb-3 mb-md-0">
                                                <input class="form-control" type="number" name="nombrePas" placeholder="Pas" value="<?= $_SESSION['nombrePas'] ?>" min="0.00" step="0.01" required>
                                            </div>
                                        </div>
                                    <?php } elseif ($_SESSION['typeChamp'] === "image") { ?>
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <p>
                                                    Pour voir la liste des images disponible sur le site, rendez-vous sur <a href="/liste_images" target="_blank">Liste images</a>. <br>
                                                    Pour en ajouter, rendez-vous sur <a href="/ajout_image" target="_blank">Ajout image</a>.
                                                </p>
                                                <textarea class="form-control" id="paramsChamp" name="paramsChamp" placeholder="Paramètres du champ (Veuillez les séparer par un point vigule suivi d'un espace '; ')" value="<?= $_SESSION['paramsChamp'] ?>" required></textarea>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <textarea class="form-control" id="paramsChamp" name="paramsChamp" placeholder="Paramètres du champ (Veuillez les séparer par un point vigule suivi d'un espace '; ')" value="<?= $_SESSION['paramsChamp'] ?>" required></textarea>
                                            </div>
                                        </div>
                                    <?php }
                                } else { ?>
                                    <label for="nomChamp">Veuillez renseigner le nom du champ <span class="font-weight-bold">sans</span> les <code>##</code>.</label>
                                    <div class="row mb-3">
                                        <div class="col-12 col-md-6 mb-3 mb-md-0">
                                            <input class="form-control" type="text" id="nomChamp" name="nomChamp" placeholder="Nom du champ" value="<?= $_POST['nomChamp'] ?>" required>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <select class="form-control" id="typeChamp" name="typeChamp" required>
                                                <option value="" disabled>---- Type de champ ----</option>
                                                <option value="number" <?= $_POST['typeChamp'] == "number" ? 'selected' : '' ?>>Nombre</option>
                                                <option value="text" <?= $_POST['typeChamp'] == "text" ? 'selected' : '' ?>>Texte</option>
                                                <option value="image" <?= $_POST['typeChamp'] == "image" ? 'selected' : '' ?>>Image</option>
                                            </select>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="row">
                                    <input class="col-4 mx-auto btn btn-primary" type="submit" name="submitChamp" value="Sauvegarder">
                                    <a class="col-4 mx-auto btn btn-danger" href="/liste_champs">Annuler</a>
                                </div>
                            </div>
                        </form>
                        <hr>
                    <?php } ?>

                    <div class="container">
                        <h3 class="text-center mb-4">Liste des champs existant</h3>
                        <div class="row">
                            <?php
                            $res = getChamps();
                            if ($res) {
                                $numRows = mysqli_num_rows($res);
                                if ($numRows > 0) {
                                    for ($i=0; $i<$numRows; $i++) {
                                        $row = mysqli_fetch_assoc($res);

                                        $typeChamp = $row['typechamp'];
                                        $typeChamp = str_replace("number", "nombre", $typeChamp);
                                        $typeChamp = str_replace("text", "texte", $typeChamp);

                                        $options = unserialize($row['parametres']);
                                        if ($row['typechamp'] == "number") {
                                            $paramsChamp = "<p>";
                                            $paramsChamp .= "Borne inférieure: ". $options[0] ."<br>";
                                            $paramsChamp .= "Borne supérieure: ". $options[1] ."<br>";
                                            $paramsChamp .= "Pas: ". $options[2];
                                            $paramsChamp .= "</p>";
                                        } else {
                                            $paramsChampTmp = implode("</li><li>", $options);
                                            $paramsChamp = "<ul><li>$paramsChampTmp</li></ul>";
                                        }
                                        ?>
                                        <div class="col-12 mb-3 p-3 enonce">
                                            <h3><?= htmlspecialchars($row['nom']) ?></h3>
                                            <p>Type: <?= $typeChamp ?></p>

                                            <?= $paramsChamp ?>

                                            <a class="btn btn-danger" href="/liste_champs/<?= $row["nom"] ?>/delete">Supprimer</a>
                                            <a class="btn btn-warning" href="/liste_champs/<?= $row["nom"] ?>/edit">Modifier</a>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    echo '<div class="col-12 mx-auto">';
                                    printError("Aucun champs disponible dans la base de données !");
                                    echo '</div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php partial("footer"); ?>