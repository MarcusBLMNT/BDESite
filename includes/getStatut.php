<?php

require '../public/api/jsonUnicode.php';
function getStatut()
{
    $bdd = bddConnect();
    if (empty($_SESSION)) {

        return 0;
    } else {
        $reponse = $bdd->prepare('SELECT id_role from utilisateur where pseudo = :pseudo');
        $reponse->bindValue(':pseudo', $_SESSION['pseudo'], PDO::PARAM_STR);
        $reponse->execute();
        $reponse = $reponse->fetchAll(PDO::FETCH_ASSOC);
        $reponse = objectToArray($reponse);
        return (int) $reponse[0]['id_role'];
    }
}
