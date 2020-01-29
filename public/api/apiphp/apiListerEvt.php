
<?php
include('../jsonUnicode.php');
header('Content-Type:application.json; charset=utf-8');
$adresseBDDJson = file_get_contents("../AdresseBDD/adresseBDD.json");
$adresseBDDJsonParsed = json_decode($adresseBDDJson);


$bdd = new PDO('mysql:host=' . $adresseBDDJsonParsed->{"host"} . ';port=' . $adresseBDDJsonParsed->{"port"} . ';dbname=' . $adresseBDDJsonParsed->{"dbname"} . ';', $adresseBDDJsonParsed->{"pseudo"}, $adresseBDDJsonParsed->{"mdp"});
$requete = $bdd->prepare("select evenement.id as idEvt, date as dateEvt, nom as nomEvt, description as descriptionEvt, url_image as imgEvt, prix, periode from evenement LEFT join temporalite on temporalite.id=evenement.id_Temporalite
");

$requete->execute();
$resultat = $requete->fetchall(PDO::FETCH_ASSOC | PDO::FETCH_GROUP);
echo jsonEncodeArray($resultat);




?>