<?php
require 'bddconnect.php';
var_dump($_POST);
$bdd = bddConnect();
$reqPseudoNomCreateur = $bdd->prepare("SELECT utilisateur.pseudo as pseudoCréateur, sujet.nom as nomSujet from sujet join utilisateur on sujet.id_utilisateur=utilisateur.id where sujet.id=:idSujet
");
$reqPseudoNomCreateur->bindValue(":idSujet", $_POST['sujet'], PDO::PARAM_INT);
$tab = $reqPseudoNomCreateur->fetchAll(PDO::FETCH_CLASS);
var_dump($tab);
