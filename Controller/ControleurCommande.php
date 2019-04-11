<?php

require_once 'Modele/Commande.php';
require_once 'Modele/Modele.php';
require('test/fpdf/PDF.php');


class ControleurCommande extends Modele { //La classe hérite de Modele pour récupérer la connexion a la bdd + l'exe des requêtes


	private $commande;
	private $client;

	public function __construct() {
		$this->client = new Client();
		$this->commande = new Commande();
	}

	//Valide le panier (créé une commande)
	public function validePanier($articlesPanier, $idClient, $prix){
		$this->commande->ajoutCommande($prix, $idClient);
		$this->commande->ajoutCoDetails($articlesPanier);
	}

		//Va chercher les détails des commandes
    public function getInfosCommandes(){
        return $this->commande->getInfosCommandes()->fetchAll();
    }

    //Va chercher les détails d'une commande
    public function getInfosCommande($idCommande){
        return $this->commande->getInfosCommande($idCommande);
    }

	//Récupère l'ensemble des commandes d'un client
    public function getCommandes($idClient){
        return $this->commande->getCommandes($idClient);
    }

    //Récupère une commande d'un utilisateur
    public function getCommande($idCommande){
        return $this->commande->getCommande($idCommande);
    }

    //Récupère les commandes traitées d'un client
    public function getCommandesValidees($idClient){
        return $this->commande->getCommandesValidees($idClient)->fetchAll();
    }

    //Renvoie l'ensemble des commandes non traitées qui sont donc à valider
    public function getAllCommandesPasValideesTP(){
        return $this->commande->getAllCommandesPasValidees()->fetchAll();
    }

    //Valide une commande (Téléprospecteur)
    public function valideCommande($idCommande){
        return $this->commande->majEtat($idCommande);
    }


		//Crée la facture PDF
		public function creerFacture($idCommande){

				ob_get_clean();

        $commande = $this->getCommande($idCommande)->fetch();
        $detailsCommande = $this->getInfosCommande($idCommande)->fetchAll(PDO::FETCH_CLASS, 'Commande');

        $codeClient = $this->client->getCodeClient($idCommande)->fetch();
        $codeClient = $codeClient['cl_login'];

				// Création de la class PDF
				$pdf = new PDF();

        $pdf->titre = "Facture " . $commande['co_num'];
        $pdf->SetTitle("Facture " . $commande['co_num']);
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 14);

        $pdf->Ln(20);
        $pdf->Cell(40, 10, "ALGOBREIZH");
        $pdf->Ln(5);
        $pdf->Cell(40, 10, iconv('utf-8', 'cp1252', "18, rue de Molène"));
        $pdf->Ln(5);
        $pdf->Cell(40, 10, "29810 LAMPAUL-PLOUARZEL");
        $pdf->Ln(5);
        $pdf->Cell(40, 10, "02.98.97.96.95");

        $pdf->Ln(10);
        $pdf->Cell(40, 10, "Code Client : " . $codeClient);
        $pdf->Ln(10);
        $pdf->Cell(40, 10, "Date de la commande : " . date("d/m/Y", strtotime($commande['co_date'])));
        $pdf->Ln(10);
        $pdf->Cell(40, 10, "Date de validation : " . date("d/m/Y", strtotime($commande['co_date_validation'])));

        $pdf->Ln(20);
        $txt = iconv('utf-8', 'cp1252', "Détail de votre commande : ");
        $pdf->Cell(80, 10, $txt);
        $pdf->Ln(20);

        $header = array("Libellé", "Quantité", "Prix");
        $pdf->BasicTable($header, $detailsCommande);
        $pdf->Ln(20);

        $euro = iconv('utf-8', 'cp1252', '€');
        $pdf->Cell(40, 10, "Total TTC : " .$commande['co_total']." ". $euro);
        $pdf->Ln(5);

        $pdf->Output('Facture_commande_'.$commande['co_num'], 'I');

				/*
		    // Header
		    function Header() {
		        // Logo
		        $this->Image('images/algobreizh.png',8,6,50);
		        $this->SetFont('Helvetica','',50);
		        $this->SetTextColor(50,255,150);
		        $this->Text(90,25,'Algobreizh');
		        // Saut de ligne
		        $this->Ln(20);
		    }
		    // Footer
		    function Footer() {
		        // Positionnement à 1,5 cm du bas
		        $this->SetY(-15);
		        // Adresse
		        $this->Cell(196,5,'AlgoBreizh - 29810 LAMPAUL-PLOUARZEL - 02.98.97.96.95',0,0,'C');
		    }


				// Activation de la classe
				$pdf = new PDF('P','mm','A4');
				$pdf->AddPage();
				$pdf->SetFont('Helvetica','',11);
				$pdf->SetTextColor(0);



				// Infos de la commande calées à gauche
				$pdf->Text(8,45,'Numero de commande');
				$pdf->Text(8,50,'dateCommande');
				$pdf->Text(8,55,'reglementCommande');



				// Infos du client calées à droite
				$pdf->Text(120,45,'Nom Prenom');
				$pdf->Text(120,50,'Adresse');
				$pdf->Text(120,55,'Code postal Ville');

				// Position de l'entête à 10mm des infos (48 + 10)
				$position_entete = 70;

				function entete_table($position_entete){
				    global $pdf;
				    //Couleurs en rgb, ici juste le red
				    $pdf->SetDrawColor(183); // Couleur du fond
				    $pdf->SetFillColor(215); // Couleur des filets
				    $pdf->SetTextColor(0); // Couleur du texte
				    $pdf->SetY($position_entete);
				    $pdf->SetX(8); //Marge de gauche
				    $pdf->Cell(148,8,'Designation',1,0,'L',1); //148 = longueur de la cellule, 8 = hauteur
				    $pdf->SetX(156); // 148+8
				    $pdf->Cell(20,8,'Quantite',1,0,'C',1);
				    $pdf->SetX(176); // 156+20
				    $pdf->Cell(24,8,'Net HT',1,0,'C',1);
				    $pdf->Ln(); // Retour à la ligne
				}
				entete_table($position_entete);

				// Liste des détails
				$position_detail = 78; // Position à 8mm de l'entête (70+8=78)

				function detail_table($position_detail){
				    global $pdf;
				    $pdf->SetFillColor(255);
				    $pdf->SetTextColor(0);
				    $pdf->SetY($position_detail);
				    $pdf->SetX(8);
				    $pdf->Cell(148,8,'Algues verte',1,0,'L',1);
				    $pdf->SetX(156);
				    $pdf->Cell(20,8,'3',1,0,'C',1);
				    $pdf->SetX(176);
				    $pdf->Cell(24,8,'15',1,0,'C',1);
				}
				detail_table($position_detail);




				// Création du PDF
				$pdf->Output();*/
		}

}
