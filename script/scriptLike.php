<?php
session_start();
$bdd = new PDO(
    'mysql:host=localhost;dbname=projetweb;charset=utf8',
    'root',
    ''
);

//$pseudo = $_SESSION['pseudo'];
//$id_photo = $_POST['id_photo'];
$pseudo = "elise";
$id_photo = 2;


$req_had_liked = $bdd->prepare('CALL has_liked(:id_photo, :user)');
$req_had_liked->bindValue(':id_photo', $id_photo, PDO::PARAM_STR);
$req_had_liked->bindValue(':user', $pseudo, PDO::PARAM_STR);


$req_like = $bdd->prepare('CALL add_like(:id_photo, :user)');
$req_like->bindValue(':id_photo', $id_photo, PDO::PARAM_STR);
$req_like->bindValue(':user', $pseudo, PDO::PARAM_STR);

$req_had_liked->execute();

if ($req_had_liked->fetch() == NULL) {
    $req_like->execute();
}

$req_like->closeCursor();
$req_had_liked->closeCursor();
