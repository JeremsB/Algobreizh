<title>Mes Commandes</title>

<?php ob_start(); ?>

<?php if(isset($_SESSION['flash']))  $this->ctrlClient->displayAlert();?>




    <?php

    if(!(empty($commandes))){

        foreach ($commandes as $commande) {?>
          <div class="affichage">
          <div class="container">
            <h4><? echo "Commande n°",$commande["co_num"];?></h4>

                            <h6>Etat : <? if($commande['co_etat'] == 0)
                                              { echo "En attente de traitement";}
                                          else{ echo "Traitée"; }?></h6>
                            <h6>Date : <?=date("d/m/Y", strtotime($commande['co_date']))?></h6><br>

                            <table class="table" style="border: 2px solid #e6ffd2">
                                <thead>
                                <tr>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Quantité</th>
                                    <th scope="col">Prix</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($detailsCommandes as $details):?>
                                    <?php if($details['co_id'] == $commande['co_id']){?>
                                        <tr>
                                            <td><?=$details["ar_name"]?></td>
                                            <td><?=$details["ar_qte"]?></td>
                                            <td><?=$details["dc_prix"]?>€</td>
                                        </tr>
                                <?php } endforeach;?>

                                </tbody>

                            </table>
              <div class="row">
              <? if ($commande['co_etat'] == 1) { ?>
                <div class="col-md-6">
                  <a href="<?= "index.php?action=creerFacture&idCommande=" . $commande['co_id'] ?>">
                      <div class="ajouterPanier">Ma facture</div>
                  </a>
                </div>
                <? } else { ?>
                <div class="col-md-6"></div>
                <? } ?>
                <div class="col-md-6">
                  <h5 style="text-align: right"><? echo "Total: ",$commande["co_total"],"€";?></h5>
                </div>
              </div>
        </div>
        </div>
            <?php
        }
    }
    else{ ?>
        <h4 class="textAccount">Vous n'avez passé aucune commande</h4>
    <?php }

    ?>




<?php $contenu = ob_get_clean();?>

<?php require "Vue/gabarit.php";?>
