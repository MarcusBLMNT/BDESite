<?php

session_start();
include('../includes/bddConnect.php');
$bdd = bddConnect();

$pseudo = $_SESSION['pseudo'];
$description = $_POST['description'];
$idpost = $_POST['post'];
$datetime = date("Y-m-d H:i:s");

$req = $bdd->prepare('Call add_post_response(:desc, :date, :pseudo, :pid_post)');
$req->bindValue(':desc', $description, PDO::PARAM_STR);
$req->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
$req->bindValue(':pcat', $cat, PDO::PARAM_STR);
$req->bindValue(':pid_post', $idpost, PDO::PARAM_STR);


$req->execute();

header('Location:../public/forum.php');
$req->closeCursor();
