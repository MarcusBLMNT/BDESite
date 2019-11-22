<?php
require '../../includes/bddConnect.php';
$bdd = bddConnect();
switch ($_POST['requete']) {
    case 'sujets':
        $requete = $bdd->prepare("SELECT * from sujet");
        break;
    default:
        $requete = $bdd->prepare('nothing');
        break;
}

$requete->execute();
$resultRequete = $requete->fetchAll(Pdo::FETCH_CLASS);
echo (json_encode($resultRequete));
