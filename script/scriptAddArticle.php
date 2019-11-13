<?php

$bdd = new PDO(
    'mysql:host=localhost;dbname=projetweb;charset=utf8',
    'root',
    ''
);

$nom = $_POST['nom'];
$description = $_POST['description'];
$prix = $_POST['prix'];
$stock = $_POST['stock'];
$cat = $_POSt['cat'];
$url = $_POST['url'];

$requete = $bdd->prepare("call add_article(:nom, :description, :prix, :stock, :cat, :url)");
$requete->bindValue(':nom', $nom, PDO::PARAM_STR);
$requete->bindValue(':description', $description, PDO::PARAM_STR);
$requete->bindValue(':prix', $prix, PDO::PARAM_STR);
$requete->bindValue(':stock', $stock, PDO::PARAM_STR);
$requete->bindValue(':cat', $cat, PDO::PARAM_STR);
$requete->bindValue(':url', $url, PDO::PARAM_STR);

$requete->execute();

$requete->closeCursor();
