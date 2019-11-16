<?php
  function bddConnect()
  {
    $adressebdd = file_get_contents('../public/api/AdresseBDD/adresseBDD.json');
    $adresseBDDJsonParsed = json_decode($adressebdd);
    $bdd = new PDO('mysql:host=' . $adresseBDDJsonParsed->{"host"} . ';port=' .
      $adresseBDDJsonParsed->{"port"} . ';dbname=' . $adresseBDDJsonParsed->{"dbname"} .
      ';', $adresseBDDJsonParsed->{"pseudo"}, $adresseBDDJsonParsed->{"mdp"});
    return $bdd;
  }
?>