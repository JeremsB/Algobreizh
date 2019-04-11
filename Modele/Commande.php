<?php

require_once 'Modele/Modele.php';

class Commande extends Modele { //La classe hérite de Modele pour récupérer la connexion a la bdd + l'exe des requêtes

	//Ajout d'une nouvelle commande
	public function ajoutCommande($idClient, $total){
		$requete = "INSERT INTO t_commandes (cl_id, co_num, co_date, co_total) VALUES(?, ?, ?, ?)";

		$date = date("Y-m-d");
		$num = rand(1, 100000);

		return $this->executerRequete($requete, array($idClient, $num, $date, $total));
	}

	//Récupère l'id de la dernière commande ajoutée
	public function derniereCommande(){
		$requete = "SELECT co_id FROM t_commandes WHERE co_date = (SELECT MAX(co_date) FROM t_commandes) ORDER BY co_id DESC";
		return $this->executerRequete($requete);
	}

	//Ajout des détails de la commande
	public function ajoutCoDetails($articlesPanier){

		$idCommande = $this->derniereCommande()->fetch();
		$idCommande = $idCommande['co_id'];

		foreach ($articlesPanier as $articlePanier){
			$requete = "INSERT INTO t_details_commandes (co_id, ar_id, ar_qte, dc_prix) VALUES (?, ?, ?, ?)";
			$qte = $articlePanier['quantite'];
			$idArticle = $articlePanier['article']['id'];
			$prix = $articlePanier['prix'];

			$this->executerRequete($requete, array($idCommande, $idArticle, $qte, $prix));
			unset($_SESSION["panier"][$idArticle]);

		}

	}

	//Détails des commandes
	public function getInfosCommandes(){
		$requete = "SELECT DC.co_id, A.ar_name, DC.ar_qte, DC.dc_prix FROM t_details_commandes DC JOIN t_articles A WHERE DC.ar_id = A.ar_id";
		return $this->executerRequete($requete);
	}

	//Détails d'une commande
	public function getInfosCommande($idCommande){
		$requete = "SELECT A.ar_name, DC.ar_qte, DC.dc_prix FROM t_details_commandes DC JOIN t_articles A WHERE DC.ar_id = A.ar_id AND DC.co_id=?";
		return $this->executerRequete($requete, array($idCommande));
	}

	//Ensemble des commandes d'un utilisateur
	public function getCommandes($idClient){
		$requete = 'SELECT * FROM t_commandes WHERE cl_id=? ORDER BY co_date DESC LIMIT 20 ';
		return $this->executerRequete($requete, array($idClient));
	}

	//Une commande d'un utilisateur
	public function getCommande($idCommande){
		$requete = 'SELECT * FROM t_commandes WHERE co_id=?';
		return $this->executerRequete($requete, array($idCommande));
	}

	//Ensemble des commandes traitées d'un client
	public function getCommandesValidees($idClient){
		$requete = 'SELECT * FROM t_commandes WHERE cl_id=? AND co_etat=?  ORDER BY co_date DESC LIMIT 20';
		return $this->executerRequete($requete, array($idClient, 1));
	}

	//Ensemble des commandes d'un client en attente de traitement
	public function getCommandesPasValidees($idClient){
		$requete = 'SELECT * FROM t_commandes WHERE cl_id=? AND co_etat=? ORDER BY co_date DESC LIMIT 20';
		return $this->executerRequete($requete, array($idClient, 0));
	}

	//Ensemble des commandes en cours de traitement (all clients)
	public function getAllCommandesPasValidees(){
		$requete = "SELECT * FROM t_commandes WHERE co_etat=0 ORDER BY co_date DESC LIMIT 20";
		return $this->executerRequete($requete);
	}

	//Passe l'état de 0 à 1 (En attente de validation --> validée)
	public function majEtat($idCommande){
		$requete = "UPDATE t_commandes SET co_etat=1, co_date_validation=? WHERE co_id=?";
		$date = date(DATE_W3C);
		return $this->executerRequete($requete, array($date, $idCommande));
	}


}

?>
