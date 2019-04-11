<title>Accueil - AlgoBreizh</title>

<?php ob_start(); ?>

<div class="affichage">
        <p>AlgoBreizh est basée à Lampaul-Plouarzel face à la Mer d'Iroise, l'un des plus grands champs
    d'algues d'Europe. Les produits que nous fabriquons sont vendus sous la marque « Plein Ouest »
    Contrairement à ce que l'on peut observer en Asie, en Europe le marché de l'algue alimentaire
    est un marché de niche. Les progressions de ces dernières années montrent que l'algue gagne du
    terrain tant auprès des restaurateurs que des particuliers.
    Depuis plus de 15 ans, toute l'équipe d'AlgoBreizh développe et fabrique une gamme originale de
    produits alimentaires à base d'algues pour le bonheur des chefs et des particuliers amateurs de
    nouvelles saveurs.</p>

    <p><i>Passionné par le monde marin, mon intérêt pour les algues est né en 1999 par le biais
    des micro-algues telle que la spiruline. Leur profil nutritionnel est exceptionnel, tout
    comme celui des macro algues. Mais l'élément qui a déclenché ma passion, c'est
    l'éventail de saveurs que l'on peut trouver dans les algues. A cette époque, l'idée de
    manger de l'algue dérangeait une large majorité d'entre nous, mais la richesse des
    saveurs, combinée à ce profil nutritionnel étonnant, m'ont amené à me dire que nous ne
    pouvions pas passer à côté de cela.</i></p>
                                                                      Yann KERADOC
</div>
                                                             
<?php $contenu = ob_get_clean();?>

<?php require "Vue/gabarit.php";?>
