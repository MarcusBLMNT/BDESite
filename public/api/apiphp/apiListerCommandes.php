
<?php
include('../jsonUnicode.php');
header('Content-Type:application.json; charset=utf-8');
$adresseBDDJson = file_get_contents("../AdresseBDD/adresseBDD.json");
$adresseBDDJsonParsed = json_decode($adresseBDDJson);


$bdd = new PDO('mysql:host=' . $adresseBDDJsonParsed->{"host"} . ';port=' . $adresseBDDJsonParsed->{"port"} . ';dbname=' . $adresseBDDJsonParsed->{"dbname"} . ';', $adresseBDDJsonParsed->{"pseudo"}, $adresseBDDJsonParsed->{"mdp"});
$requete = $bdd->prepare("select distinct commande.id as idCommande, pseudo as createur, commande.date as dateCommande, faite, article.nom as nomArticle, commandearticle.quantite as quantite from article join commandearticle on article.id=commandearticle.id_Article join commande on commandearticle.id_commande=commande.id join utilisateur on commande.id_Utilisateur=utilisateur.id
");

$requete->execute();
$resultat = $requete->fetchall(PDO::FETCH_ASSOC | PDO::FETCH_GROUP);
echo jsonEncodeArray($resultat);








?>