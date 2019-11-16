<?php
session_start();
$bdd = new PDO(
    'mysql:host=localhost;dbname=projetweb;charset=utf8',
    'root',
    ''
);


$pseudo = "elise";
$idarticle = 2;
//$datetime = date("Y-m-d H:i:s");
$datetime = "2019-11-13";

//requete verifiant si une commande est en cours
$req_any_cart = $bdd->prepare('CALL any_cart(:pseudo)');
$req_any_cart->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);


//requete créant une nouvelle commande
$req_add_new_order = $bdd->prepare('CALL add_order(:datetime, 0, :pseudo)');
$req_add_new_order->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
$req_add_new_order->bindValue(':datetime', $datetime, PDO::PARAM_STR);


//VOIR ERREUR PLUS TARD

//verif si une commande est en cours
$req_any_cart->execute();
$table = array();
while ($data = $req_any_cart->fetch()) {
    $table[] = $data['id'];
}

//si non en créer une
if ($table == NULL) {
    $req_add_new_order->execute();
    echo "cc";
    //a verifier
    $req_any_cart->execute();
    $table2 = array();
    while ($data = $req_any_cart->fetch()) {
        $table2[] = $data['id'];
    }
    $id_commande = $table2[0];
} else {
    $id_commande = $table[0];
}

echo $id_commande;

//récupérer l'id de la commande en cours




//requete vérifiant si l'article est déja dans la base
$req_is_article_already_in = $bdd->prepare('CALL is_article_already_in(:id_article, :id_commande)');
$req_is_article_already_in->bindValue(':id_commande', $id_commande, PDO::PARAM_STR);
$req_is_article_already_in->bindValue(':id_article', $idarticle, PDO::PARAM_STR);

//requete ajoutant un nouvel article au panier
$req_add_to_panier = $bdd->prepare('CALL add_order_article(:idorder, :id_article, 1)');
$req_add_to_panier->bindValue(':idorder', $id_commande, PDO::PARAM_STR);
$req_add_to_panier->bindValue(':id_article', $idarticle, PDO::PARAM_STR);

//requete ajoutant 1 a la quantité d'un article
$req_one_more_article = $bdd->prepare('CALL one_more_article(:id_article, :id_commande)');
$req_one_more_article->bindValue(':id_commande', $id_commande, PDO::PARAM_STR);
$req_one_more_article->bindValue(':id_article', $idarticle, PDO::PARAM_STR);


// l'article est t il déja dans le panier
$req_is_article_already_in->execute();

$tab = array();
while ($data = $req_is_article_already_in->fetch()) {
    $tab[] = $data['quantite'];
}
echo $tab[0];


//si oui ajouter un à la quantité, sinon créer un nouvel enregistrement
if ($tab == NULL) {
    echo "cc";
    $req_add_to_panier->execute();
} else {

    $req_one_more_article->execute();
    echo "slt";
}

$req_add_to_panier->closeCursor();
$req_one_more_article->closeCursor();
$req_is_article_already_in->closeCursor();
$req_any_cart->closeCursor();
$req_add_new_order->closeCursor();
