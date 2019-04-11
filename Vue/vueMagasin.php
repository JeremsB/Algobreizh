<title>Articles - AlgoBreizh</title>

<?php foreach ($articles as $article):?>

    <div class="affichage">
        <div class="container">

            <div class="row">
                <div class="col-md-8">
                    <h1 class="titreArticle"><?= $article['name'] ?></h1> <br/ >
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <img src="<?= $article['picture'] ?>" height="180px" width="180px" style="border-radius:15px; border: 4px double white;">
                </div>
                <div class="col-md-9">
                    <?= $article['description'] ?>
                </div>
            </div>

            <br/ >

            <div class="row">
                <div class="col-md-2" style="margin-top:10px;">
                    <h4><?= $article['price'] ?>€</h4>
                </div>

                <?php if (!isset($_SESSION['client']) || $_SESSION['client']['profil'] == 'client') { ?> <!-- Si pas connecté ou si profil = client alors afficher le bouton ajouter au panier -->
                <div class="col-md-3">
                    <a href="<?= "index.php?action=ajoutPanier&idArticle=" . $article['id'] ?>">
                        <div class="ajouterPanier">Ajouter au panier</div>
                    </a>
                </div>

              <?php } ?>
            </div>

        </div>
    </div>

<?php endforeach; ?>
