<?php

header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=fichier.csv");
header("Pragma: no-cache");
header("Expires: 0");

$bdd = new PDO(
    'mysql:host=localhost;dbname=projetweb;charset=utf8',
    'root',
    ''
);
//$id_evenement = $_POST['event'];

$requete = $bdd->prepare('CALL list_inscrit(1);');
//$requete->bindValue(':id_event', $id_evenement, PDO::PARAM_STR);
$requete->execute();

while ($row =  $requete->fetch(PDO::FETCH_ASSOC)) {
    echo implode(';', $row) . "\r\n";
}
exit();
