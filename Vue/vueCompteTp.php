<title>Téléprospecteur</title>

<?php ob_start(); ?>

<?php if(isset($_SESSION['flash']))  $this->ctrlClient->displayAlert();?>


    <?php if(!(empty($commandes))){?>

        <form action="index.php?action=validerCommande" method="post">

            <?php foreach ($commandes as $commande) {?>
                <!--<table>
                    <tbody>-->
                          <div class="affichage">
                              <div class="container">

                                    <h4> <?=$commande['co_num']?> </h4>
                                    <h6>Code client :
                                        <?php foreach ($codeClient as $idCommande => $code) {
                                            if(strval($idCommande) == $commande["co_id"])
                                                echo $code;
                                            }?></h6>
                  									<h6>Date : <?=date("d/m/Y", strtotime($commande['co_date']))?></h6>
                  									<h6>Total : <?=$commande['co_total']?> €</h6><br>

                                    <table class="table" style="border: 2px solid #e6ffd2">
                    										<thead>
                        										<tr>
                          											<th>Article</th>
                          											<th>Quantité</th>
                          											<th>Prix</th>
                        										</tr>
                    										</thead>
		                                    <tbody>

                      											<?php foreach ($detailsCommande as $details):?>
                      												<?php if($details['co_id'] == $commande['co_id']){?>
                      													<tr>
                      														<td><?=$details["ar_name"]?></td>
                      														<td><?=$details["ar_qte"]?></td>
                      														<td><?=$details["dc_prix"]?></td>
                      													</tr>
                      												<?php } endforeach;?>

                  											</tbody>

                                    </table>

                                    <div class="row">
                                        <div class="col-md-1">
                                            <label>Traitée</label>
                                        </div>
                                        <div class="col-md-1" style="margin-top:6px;">
                                            <input type="checkbox" name="commande[]" value="<?=$commande['co_id']?>" />
                                        </div>
                                    </div>
                          </div>
                      </div>
                  <!--</tbody>
              </table>-->
					<?php } ?>

          <div class="row justify-content-md-center">
              <div class="col-md-3"><input class="ajouterPanier" type="submit" value="Valider les traitements"></div>
          </div>

      </form>

      <?php }

      else { ?>
          <h4 class="textAccount">Aucune commande n'est en attente de traitement</h4>
      <?php } ?>

  <div class="container">

      <div class="row justify-content-md-center">
          <div class="col-md-3">
              <br>
              <a href="index.php?action=deconnexion">
                  <div class="ajouterPanier">Se déconnecter</div>
              </a>
              <br>
          </div>
      </div>

  </div>

<?php $contenu = ob_get_clean();?>

<?php require "Vue/gabarit.php";?>
