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

$req_any_cart->execute();
$req_any_cart->closeCursor();
$id_commande = 5;

//requete vérifiant si l'article est déja dans la base
$req_is_article_already_in = $bdd->prepare("CALL is_article_already_in(:id_article, :id_commande)");
$req_is_article_already_in->bindValue(':id_commande', $id_commande, PDO::PARAM_STR);
$req_is_article_already_in->bindValue(':id_article', $idarticle, PDO::PARAM_STR);


//requete ajoutant un nouvel article au panier
$req_is_article_already_in->execute();
$tab = array();
while ($data = $req_is_article_already_in->fetch()) {
    $tab[] = $data['quantite'];
}
echo $tab[0];
$req_is_article_already_in->closeCursor();

$req_add_new_order->closeCursor();
