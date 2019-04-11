<title>Mon Panier - AlgoBreizh</title>

<?php ob_start(); ?>

<h1> Mon Panier </h1>

  <?php if(count($_SESSION["panier"])!=0){ ; ?>

      <?php foreach ($articlesPanier as $articlePanier):?>

          <div class="affichage">
              <div class="container">

                  <div class="row">
                      <div class="col-md-6">
                          <h3><?=$articlePanier['article']['name']?></h3>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-4">
                          <img src="<?=$articlePanier['article']['picture']?>" height="150px" width="150px" style="border-radius:15px; border: 4px double white";>
                      </div>
                      <div class="col-md-4">
                          <h5>Quantité - <a href="index.php?page=panier&action=retirerArticlePanier&idArticle=<?=$articlePanier['article']['id']?>">
                          <img src="images/minus.png" width="20"></a>
                          <?=$articlePanier['quantite']?> <a href="index.php?page=panier&action=ajoutArticlePanier&idArticle=<?=$articlePanier['article']['id']?>"><img src="images/plus.png" width="20"></a></h5>
                      </div>
                      <div class="col-md-2">
                          <h5><?=$articlePanier['prix']." €"?></h5>
                      </div>
                      <div class="col-md-2">
                          <a href="index.php?page=panier&action=supprimerArticlePanier&idArticle=<?=$articlePanier['article']['id']?>"><img src="images/trash.png" width="35"></a>
                      </div>
                  </div>
</div>
</div>
            <?php endforeach;?>

            <div class="affichage">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <h4>Total : <?=$total." €"?></h4>
                        </div>
                        <div class="col-md-4">
                            <div><a  href="index.php?page=panier&action=validePanier"><button class="ajouterPanier" >Valider la commande</button></a></p></div>
                        </div>
                    </div>
                </div>
            </div>









    <?php }
    else {

        if (isset($_SESSION['client'])) {
            if ($_SESSION['client']['profil'] == 'client') {
                ?>
                <h4>Vous n'avez aucun article dans votre panier</h4>
                <?php
            }
            else {
                ?>
                <h4>Vous n'avez pas la possibilité de passer de commandes en tant que téléprospecteur</h4>
                <?php
            }
        }
    }
    ?>



<?php $contenu = ob_get_clean();?>

<?php require "Vue/gabarit.php";?>

<?php /*
<table>
    <?php foreach ($articlesPanier as $articlePanier):?>
        <tr>
            <td><img src="<?=$articlePanier['article']['picture']?>" height="150px" width="150px"></td>
            <td><?=$articlePanier['article']['name']?></td>
            <td> - Quantité</td>
            <td><?=$articlePanier['quantite']?> - </td>
            <td><a href="index.php?page=panier&action=retirerArticlePanier&idArticle=<?=$articlePanier['article']['id']?>">
              <img src="images/minus.png" width="20"></a>
              <?=$articlePanier['quantite']?> <a href="index.php?page=panier&action=ajoutArticlePanier&idArticle=<?=$articlePanier['article']['id']?>"><img src="images/plus.png" width="20"></a></td>
            <td><?=" - ".$articlePanier['prix']." €"?></td>
            <td><a href="index.php?page=panier&action=supprimerArticlePanier&idArticle=<?=$articlePanier['article']['id']?>"><img src="images/trash.png" width="25"></a></td>
        </tr>
    <?php endforeach;?>
</table>
</div>

<br>
<p>Total : <?=$total." €"?></p>
<div><a  href="index.php?page=panier&action=validePanier"><button>Valider la commande</button></a></p></div>
*/ ?>
