<?php
session_start();
include('../includes/bddConnect.php');
$bdd = bddConnect();


$pseudo = $_POST['pseudo'];
$motDePasse = $_POST['motDePasse'];


$requete = $bdd->prepare("call connect(:pseudo, :motDePasse)");
$requete->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
$requete->bindValue(':motDePasse', $motDePasse, PDO::PARAM_STR);

$requete->execute();
var_dump($bdd->errorInfo());

if ($requete->fetch() != NULL) {
    $_SESSION['pseudo'] = $pseudo;
    header('Location: ../public/indexAccueil.php');
} else {
    echo "Connexion échouée";
    echo $_POST['pseudo'];
}

$requete->closeCursor();
