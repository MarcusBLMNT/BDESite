<?php
session_start();
//Script de connexion
include('../includes/bddConnect.php');
$bdd = bddConnect();


$pseudo = $_POST['pseudo'];
$motDePasse = $_POST['motDePasse'];

//verifie que le pseudo et le mot de passe correspondent à un utilisateur
$requete = $bdd->prepare("call connect(:pseudo, :motDePasse)");
$requete->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
$requete->bindValue(':motDePasse', $motDePasse, PDO::PARAM_STR);

$requete->execute();

//si oui l'utilisateur est connecté, sinon c'est échoué
if ($requete->fetch() != NULL) {
    $_SESSION['pseudo'] = $pseudo;
    header('Location: ../public/indexAccueil.php');
} else {
    echo "Connexion échouée";
}

$requete->closeCursor();
