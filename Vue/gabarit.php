<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="Contenu/css/bootstrap.min.css" />
        <link rel="stylesheet" href="Contenu/css/style.css" />
        <link rel="stylesheet" href="Contenu/css/form.css" />
        <title><?= $titre ?></title>
    </head>
    <body>
        <div id="global">
            <header>

            <div class= "container">
              <div class= "row">
                <div class="col-md-2">
                  <img src="images/algobreizh.png" style="display: inline-block; width: 100px; margin-top:20px">
                </div>
                <div class="col-md-8">
                  <a href="index.php?page=acceuil"><h1 id="titreMagasin" style="font-weight: 800;">Algobreizh</h1></a>
                </div>
              </div>
            </div>

				<div class="container">
					<div class="row">

						<div class="col-md-2">
								<a href="index.php?page=accueil">
                  <div class="menu">Accueil</div>
                </a>
						</div>

						<div class="col-md-2">
								<a href="index.php?page=infos">
                  <div class="menu">Informations</div>
                </a>
						</div>

						<div class="col-md-2">
								<a href="index.php?action=magasin">
                  <div class="menu">Produits</div>
                </a>
						</div>

						<div class="col-md-2">
								<a href="index.php?page=panier">
                  <div class="menu">Panier</div>
                </a>
						</div>

						<div class="col-md-2">
								<a href="index.php?page=connexion">
                    <div class="menu">Mon Compte</div>
                </a>
						</div>

            <div class="col-md-2">
                <a href="index.php?page=inscription">
                  <div class="menu">Inscription</div>
                </a>
            </div>

					</div>
				</div>


            </header>

			<br>

            <div id="contenu">
                <?= $contenu ?>
            </div>

            <footer id="piedMagasin">
                Algobreizh Copyright - 2018
            </footer>
        </div> <!-- #global -->
    </body>

<script src="Contenu/js/jquery-1.11.1.min.js"></script>
<script src="Contenu/js/bootstrap.min.js"></script>

</html>
