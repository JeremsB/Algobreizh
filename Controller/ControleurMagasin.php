<?php

require_once 'Modele/Article.php';
require_once 'Vue/Vue.php';

class ControleurMagasin {

    private $article;

    public function __construct() {
        $this->article = new Article();
    }

	// Affiche la liste de tous les articles du magasin
    public function magasin() {
        $articles = $this->article->getArticles();
        $vue = new Vue("Magasin");
        $vue->generer(array('articles' => $articles));
    }

}
