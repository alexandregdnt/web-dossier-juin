<?php partial("header"); ?>

    <header class="bg-primary text-white">
        <div class="container text-center">
            <h1>Génération d'énoncés</h1>
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
                                <a class="col-4 mx-auto btn btn-success" href="./generated/<?= $_POST['generatedFileId'] ?>.html" download="Enoncé généré.html">Télécharger ici</a>
                                <a class="col-4 mx-auto btn btn-secondary" href="./generated/<?= $_POST['generatedFileId'] ?>.html" target="_blank">Visualiser ici</a>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="container">
                        <h3 class="text-center mb-4">Liste des énoncés disponible</h3>
                        <div class="row">
                            <?php
                            $res = getEnonces();
                            if ($res) {
                                $numRows = mysqli_num_rows($res);
                                if ($numRows > 0) {
                                    for ($i=0; $i<$numRows; $i++) {
                                        $row = mysqli_fetch_assoc($res);

                                        ?>
                                        <div class="col-12 mb-3 p-3 enonce">
                                            <p><?= $row["contenu"] ?></p>
                                            <a class="btn btn-primary" href="./generation_enonce_<?= $row["idEnonce"] ?>">Choisir celui-ci !</a>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    echo '<div class="col-12 mx-auto">';
                                    printError("Aucun énoncés disponible dans la base de données !");
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