<?php

require_once 'Modele/Article.php';
require_once 'Vue/Vue.php';

class ControleurArticle {

    private $article;

    public function __construct() {
        $this->article = new Article();
    }

    // Affiche les détails sur un article
    public function article($idArticle) {
        $article = $this->article->getArticle($idArticle);
        $vue = new Vue("Article");
        $vue->generer(array('article' => $article));
    }

    //Renvoie le prix total de la commande
    public function getPrixTotal($articlesPanier)
    {
        $prixTotal = 0;
        foreach ($articlesPanier as $article) {
            $prixTotal += $article["prix"];
        }

        //$prixTotal = number_format($prixTotal, 2);
        return $prixTotal;
    }

    //Ajout d'un article au panier
    public function ajoutArticlePanier($idArticle, $panier)
    {
        if (array_key_exists($idArticle, $panier)) {
            $_SESSION["panier"][$idArticle]++;
        }
        else {
            $_SESSION["panier"][$idArticle] = 1;
        }
    }

    //Renvoie les informations des articles du panier
    public function getArticlesPanier($panier)
    {

        //On initialise un tableau qui viendra récupérer, pour chaque article du panier,
        // les informations de l'article, la quantité et le montant
        $infosArticles = [];

        foreach ($panier as $id => $qte) {

            $article = $this->article->getArticle($id);
            $prix = $article["price"] * $qte;

            $infosArticles[] = array("article" => $article, "quantite" => $qte, "prix" => $prix);
        }

        return $infosArticles;

    }

    //Supprime un article du panier
    public function supprimerArticlePanier($idArticle)
    {
        unset($_SESSION["panier"][$idArticle]);
    }

    //Réduit la quantité d'un article du panier
    public function retirerArticlePanier($idArticle)
    {
        if ($_SESSION["panier"][$idArticle] > 1)
            $_SESSION["panier"][$idArticle] = $_SESSION["panier"][$idArticle] - 1;
        else
            unset($_SESSION["panier"][$idArticle]);
    }

}
