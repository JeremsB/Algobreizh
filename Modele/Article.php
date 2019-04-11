<?php

require_once 'Modele/Modele.php';

/**
 * Fournit les services d'accès aux genres musicaux
 *
 */
class Article extends Modele {

    /** Renvoie la liste des articles du magasin
     *
     * @return PDOStatement La liste des articles
     */
    public function getArticles() {
        $sql = 'select ar_id as id, ar_name as name, ar_desc as description, ar_pic as picture, ar_price as price'
                . ' from t_articles';
        $articles = $this->executerRequete($sql);
        return $articles;
    }

    /** Renvoie les informations sur un article
     *
     * @param int $id L'identifiant de l'article
     * @return array L'article
     * @throws Exception Si l'identifiant de l'article est inconnu
     */
    public function getArticle($idArticle) {
        $sql = 'select ar_id as id, ar_name as name, ar_desc as description, ar_pic as picture, ar_price as price'
                . ' from t_articles'
                . ' where ar_id=?';
        $article = $this->executerRequete($sql, array($idArticle));
        if ($article->rowCount() > 0)
            return $article->fetch();  // Accès à la première ligne de résultat
        else
            throw new Exception("Aucun article ne correspond à l'identifiant '$idArticle'");
    }

}
