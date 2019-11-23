<?php
require '../../includes/bddConnect.php';
require '../api/jsonUnicode.php';
header('content-type:application/json');
$bdd = bddConnect();


switch ($_POST['requete']) {

    case 'sujets':
        $requete = $bdd->prepare("SELECT * FROM `sujet`");
        break;
    default:
        $requete = '0';
        break;
}
if ($requete != '0') {
    $requete->execute();
    $resultRequete = $requete->fetchAll(PDO::FETCH_CLASS);
    $truc = objectToArray($resultRequete);
    $truc = jsonEncodeArray($truc);
    echo ($truc);
} else {
    echo $requete;
}
