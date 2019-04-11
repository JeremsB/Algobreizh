<title>Mon compte</title>

<?php ob_start(); ?>

<?php if(isset($_SESSION['flash']))  $this->ctrlClient->displayAlert();?>

<div class="container">

  <div class="row justify-content-md-center">

      <div class="col-md-4">

          <div class="ajouterPanier" style="width: 200px;">
            <a href="index.php?page=mesCommandes">Mes commandes</a>
          </div>

      </div>

      <div class="col-md-4">

          <div class="ajouterPanier" style="width: 200px;">
            <a href="index.php?action=deconnexion">Se déconnecter</a>
          </div>

      </div>

      <div class="col-md-4">

          <div class="ajouterPanier" style="width: 200px;">
            <a href="index.php?action=desinscrire">Se désinscrire</a>
          </div>

      </div>

    </div>

</div>


<?php $contenu = ob_get_clean();?>

<?php require "Vue/gabarit.php";?>
