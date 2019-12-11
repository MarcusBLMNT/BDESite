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

            $requete = $bdd->prepare("SELECT sujet.*,categoriesujet.nom as categorie
            FROM `sujet` join categoriesujet on sujet.id_categorie=categoriesujet.id where categoriesujet.nom='"
                . utf8_decode($_POST['categorie']) . "' " . $limit . " " . $offset);

            break;
        case 'count':
            $requete = $bdd->prepare("SELECT categoriesujet.nom ,count(*) as nbSujet 
            from categoriesujet join sujet on categoriesujet.id=sujet.id_categorie group by categoriesujet.nom ");
            break;
        case 'newComment':

            $getIdUser = $bdd->prepare('SELECT id from utilisateur where pseudo = :pseudo');
            $getIdUser->bindValue(':pseudo', $_POST['createur'], PDO::PARAM_STR);
            $getIdUser->execute();
            $getIdUser = $getIdUser->fetchAll(PDO::FETCH_CLASS);
            $getIdUser = objectToArray($getIdUser);
            $requete = $bdd->prepare("INSERT INTO `message` ( `corps`, `id_utilisateur`, `id_sujet`) VALUES (:corps, :idUser, :idSujet); ");
            $requete->bindValue(':corps', utf8_decode($_POST['corps']), PDO::PARAM_STR);
            $requete->bindValue(':idUser', $getIdUser[0]['id'], PDO::PARAM_INT);
            $requete->bindValue(':idSujet', $_POST['sujet'], PDO::PARAM_INT);

            break;
        case 'getComment':
            $requete = $bdd->prepare("SELECT message.id as id, message.date as datemsg, corps, utilisateur.pseudo
            from message join sujet on message.id_sujet=sujet.id join utilisateur on message.id_utilisateur=utilisateur.id where sujet.id=:idSujet order by datemsg ASC");
            $requete->bindValue(':idSujet', $_POST['sujet'], PDO::PARAM_STR);
            break;
        case 'signalerMessage':
            $requete = $bdd->prepare("INSERT INTO `signalemessage` (`id_utilisateur`, `id_message`)
                VALUES (:idUsr, :idMsg);");
            $requete->bindValue(':idUsr', $_POST['idUsr'], PDO::PARAM_STR);
            $requete->bindValue(':idMsg',  $_POST['idMessage'], PDO::PARAM_STR);
            break;
        case 'signalerSujet':
            $requete = $bdd->prepare("INSERT INTO `signalesujet` (`id_utilisateur`, `id_sujet`)
            VALUES (:idUsr, :idSujet);");
            $requete->bindValue(':idUsr', $_POST['idUsr'], PDO::PARAM_STR);
            $requete->bindValue(':idSujet',  $_POST['idSujet'], PDO::PARAM_STR);
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
        echo $limit;
        echo $offset;
    }
} else {

    echo '0';
}
