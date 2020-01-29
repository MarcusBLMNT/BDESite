<?php
//création d'un fichier csv de la liste des inscrits pour un évènement donné
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=fichier.csv");
header("Pragma: no-cache");
header("Expires: 0");
include('../includes/bddConnect.php');

$bdd = bddConnect();
$id_evenement = $_POST['event'];

$requete = $bdd->prepare('CALL list_inscrit(:id_event);');
$requete->bindValue(':id_event', $id_evenement, PDO::PARAM_STR);
$requete->execute();

while ($row =  $requete->fetch(PDO::FETCH_ASSOC)) {
    echo implode(';', $row) . "\r\n";
}
exit();
