<?php

$bdd = new PDO(
    'mysql:host=localhost;dbname=projetweb;charset=utf8',
    'root',
    ''
);

$pseudo = $_POST['pseudo'];
$motDePasse = $_POST['motDePasse'];

$requete = $bdd->prepare("call connect(:pseudo, :motDePasse)");
$requete->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
$requete->bindValue(':motDePasse', $motDePasse, PDO::PARAM_STR);

$requete->execute();

if ($requete->fetch() != NULL) {
    header('Location: ../public/index.php');
} else {
    echo "Connexion échouée";
}

$requete->closeCursor();
