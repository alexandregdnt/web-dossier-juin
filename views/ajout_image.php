<?php partial("header"); ?>

    <header class="bg-primary text-white">
        <div class="container text-center">
            <h1>Ajout image</h1>
        </div>
    </header>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <!--
                    The form also needs the following attribute: enctype="multipart/form-data". It specifies which content-type to use when submitting the form
                    Without the requirements above, the file upload will not work.
                    -->
                    <form action="/<?= getBaseDirectory() ?>/ajout_image" method="POST" enctype="multipart/form-data">
                        <h4 class="text-center mb-4">Ajouter une image à la bibliothèque</h4>
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

                        <div class="row mb-3">
                            <div class="col-12 col-md-6 mb-3 mb-md-0">
                                <input class="form-control" type="file" accept="image/png, image/jpg, image/jpeg, image/gif, image/webp" name="fileToUpload" placeholder="Fichier à mettre en ligne" value="" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <input class="form-control" type="text" name="fileName" placeholder="Nom du fichier" value="" required>
                            </div>
                        </div>

                        <input class="btn btn-primary" type="submit" name="submitAddFile" value="Envoyer">
                    </form>
                </div>
            </div>
        </div>
    </section>

<?php partial("footer"); ?>