<?php
include('bddconnect.php');
$bdd = bddConnect();


?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Titre de la page</title>


</head>

<body onload="count()">

    <!-- pour chaque catégorie, créer une carte avec de quoi changer de page. pour chaque catégorie,
    il faudra faire un count* de toutes les données de cette catégorie afin de connaitre le nombre de boutons à afficher
    chaque page contient 10 résultats (sauf potentiellement la derniere).


    du coup pour chaque bouton, on calcule son nom(1,2,3,4...), on calcule l'offset(son nom*10, la limite êtant toujours égale à 10) et on envoie ces valeurs
    à la fonction js qui va s'occuper du reste -->
    <div id="resultatAjax" class="row">

    </div>


</body>

<script type="text/javascript" src="../public/js/forum.js"></script>

</html>