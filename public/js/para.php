<?php
require '../../includes/bddConnect.php';
require '../api/jsonUnicode.php';
header('content-type:application/json');
$bdd = bddConnect();

if (isset($_POST['requete']) && !empty($_POST['requete'])) {
    //on set la limite et l'offset
    if (isset($_POST['offset']) && !empty($_POST['offset'])) {
        $offset = 'OFFSET ' . $_POST['offset'];
    } else {
        $offset = '';
    }
    if (isset($_POST['limit']) && !empty($_POST['limit'])) {
        $limit = 'LIMIT ' . $_POST['limit'] . ' ';
    } else {
        $limit = '';
    }


    switch ($_POST['requete']) {

        case 'sujets':

            $requete = $bdd->prepare("SELECT * FROM `sujet` " . $limit . $offset);

            break;
        case 'count':
            $requete = $bdd->prepare("SELECT categoriesujet.nom ,count(*) as nbSujet 
            from categoriesujet join sujet on categoriesujet.id=sujet.id_categorie group by categoriesujet.nom " . $limit . $offset);
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
} else {

    echo '0';
}
