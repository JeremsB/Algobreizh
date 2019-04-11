<?php $this->titre = "Algobreizh - " . $article['name']; ?>

<head>
    <link rel="stylesheet" href="Contenu/css/article.css" />
</head>

<article>
    <header>
        <br/>
        <hr/>
        <h1 class="titreArticle"><?= $article['name'] ?></h1>
    </header>

        <div id="aff_article"> <!-- Div globale de l'article -->

            <div id="art_img"> <!-- Div de l'image de l'article -->
                <img src="<?= $article['picture'] ?>">
            </div>

            <div id="art_infos"> <!-- Div des infos de l'article -->
                <div id="art_desc"> <!-- Div de la description de l'article -->
                    <p><?= $article['description'] ?></p>
                </div>

                <div id="art_autres"> <!-- Div du prix + ajouter au panier -->
                    <bold><?= $article['price'] ?>€</bold>
                    <br/>
                    <?php if ($_SESSION['client']['profil'] == 'client' || !isset($_SESSION['client'])) { ?> <!-- Si pas connecté ou si profil = client alors afficher le bouton ajouter au panier -->

                      <div class="ajouterPanier">
                          <a href="index.php?action=ajoutArticlePanier&idArticle=<?php $article['id'] ?>">Ajouter au panier</a>
                          <br />
                          <a href="<?= "index.php?action=ajoutPanier&idArticle=" . $article['id'] ?>">Ajouter au panier</a>
                      </div>

                    <?php } ?>
                </div>
            </div>

        </div>

</article>
