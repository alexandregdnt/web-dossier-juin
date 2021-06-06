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

                    <?php if (isset($_GET['id']) && !empty($_GET['id']) && (!isset($_POST['error']) || empty($_POST['error'])) && (isset($_POST['generatedFileId']) && !empty($_POST['generatedFileId']))) { ?>
                        <h3 class="text-center mb-4">Enoncé généré</h3>
                        <div class="container mb-5">
                            <div class="row mb-1">
                                <p>Identifiant de l'énoncé généré: <span class="font-weight-bold"><?= $_POST['generatedFileId'] ?></span></p>
                            </div>
                            <div class="row">
                                <a class="col-4 mx-auto btn btn-success" href="/<?= getBaseDirectory() ?>/generated/<?= $_POST['generatedFileId'] ?>.html" download="Enoncé généré.html">Télécharger ici</a>
                                <a class="col-4 mx-auto btn btn-secondary" href="/<?= getBaseDirectory() ?>/generated/<?= $_POST['generatedFileId'] ?>.html" target="_blank">Visualiser ici</a>
                            </div>
                        </div>
                        <hr>
                    <?php } ?>

                    <?php if (isset($_GET['id']) && !empty($_GET['id']) && (!isset($_POST['error']) || empty($_POST['error'])) && (isset($_POST['enonceEditContent']) && !empty($_POST['enonceEditContent'])) && (isset($_POST['enonceEditId']) && !empty($_POST['enonceEditId']))) { ?>
                        <form action="/<?= getBaseDirectory() ?>/liste_enonces" method="POST">
                            <h3 class="text-center mb-4">Modification énoncé</h3>
                            <div class="container mb-5">
                                <div class="row mx-auto mb-1">
                                    <div class="col-12">
                                        <input type="hidden" name="enonceEditId" value="<?= $_POST['enonceEditId'] ?>">
                                        <input type="hidden" id="enonceEditContent" name="enonceEditContent" value="<?= htmlspecialchars($_POST['enonceEditContent']) ?>">
                                        <trix-editor input="enonceEditContent" class="trix-content"></trix-editor>
                                    </div>
                                </div>
                                <div class="row">
                                    <input class="col-4 mx-auto btn btn-primary" type="submit" name="enonceEditSubmit" value="Sauvegarder">
                                    <a class="col-4 mx-auto btn btn-danger" href="/<?= getBaseDirectory() ?>/liste_enonces">Annuler</a>
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

                                            <a class="btn btn-danger" href="/<?= getBaseDirectory() ?>/liste_champs/<?= $row["nomChamp"] ?>/delete">Supprimer</a>
                                            <a class="btn btn-warning" href="/<?= getBaseDirectory() ?>/liste_champs/<?= $row["nomChamp"] ?>/edit">Modifier</a>
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