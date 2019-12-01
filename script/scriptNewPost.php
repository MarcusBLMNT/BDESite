<?php

session_start();
include('../includes/bddConnect.php');
$bdd = bddConnect();

$pseudo = $_SESSION['pseudo'];
$nom = $_POST['nom'];
$description = $_POST['description'];
$cat = $_POST['choix'];
$datetime = date("Y-m-d H:i:s");

$req = $bdd->prepare('Call add_post(:desc, :date, :pseudo, :pcat, :pnom)');
$req->bindValue(':desc', $description, PDO::PARAM_STR);
$req->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
$req->bindValue(':pcat', $cat, PDO::PARAM_STR);
$req->bindValue(':pnom', $nom, PDO::PARAM_STR);
$req->bindValue(':date', $datetime, PDO::PARAM_STR);

$req->execute();

header('Location:../public/forum.php');
$req->closeCursor();
