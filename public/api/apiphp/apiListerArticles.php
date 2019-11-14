
<?php
include('../jsonUnicode.php');
header('Content-Type:application.json; charset=utf-8');
$adresseBDDJson=file_get_contents("../AdresseBDD/adresseBDD.json");
$adresseBDDJsonParsed=json_decode($adresseBDDJson);


$bdd=new PDO('mysql:host='.$adresseBDDJsonParsed->{"host"}.';port='.$adresseBDDJsonParsed->{"port"}.';dbname='.$adresseBDDJsonParsed->{"dbname"}.';',$adresseBDDJsonParsed->{"pseudo"},$adresseBDDJsonParsed->{"mdp"});
$requete=$bdd->prepare("SELECT article.id, article.nom as article, description, nb_vendu,prix,stock,categorie.nom as categorie FROM article join categorie on article.id_Categorie=categorie.id
");

$requete->execute();
$resultat=$requete->fetchall(PDO::FETCH_ASSOC|PDO::FETCH_GROUP);
echo jsonEncodeArray($resultat);






  

?>