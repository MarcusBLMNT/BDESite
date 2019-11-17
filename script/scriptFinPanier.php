<?php
session_start();
include('../includes/bddConnect.php');
$bdd = bddConnect();

$pseudo = $_SESSION['pseudo'];


$req = $bdd->prepare('CALL commande_faite(:p_user)');
$req->bindValue(':p_user', $pseudo, PDO::PARAM_STR);
$req->execute();
$req->closeCursor();
exit();
