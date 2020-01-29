
<?php
include('../jsonUnicode.php');
header('Content-Type:application.json; charset=utf-8');
$adresseBDDJson = file_get_contents("../AdresseBDD/adresseBDD.json");
$adresseBDDJsonParsed = json_decode($adresseBDDJson);


$bdd = new PDO('mysql:host=' . $adresseBDDJsonParsed->{"host"} . ';port=' . $adresseBDDJsonParsed->{"port"} . ';dbname=' . $adresseBDDJsonParsed->{"dbname"} . ';', $adresseBDDJsonParsed->{"pseudo"}, $adresseBDDJsonParsed->{"mdp"});
$requete = $bdd->prepare("CALL view_Boutique");

$requete->execute();
$resultat = $requete->fetchall(PDO::FETCH_ASSOC);
echo jsonEncodeArray($resultat);








?>