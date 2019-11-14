<?php

include('../includes/bddConnect.php');
include('../public/api/jsonUnicode.php');
//$_SESSION['pseudo'] = "elise";
//$_SESSION['motDePasse'] = "mdp";



?>
<!doctype html>

<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Titre de la page</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <?php

    $bdd = bddConnect();


    $requete = $bdd->prepare("SELECT date , nom, description, url_image, prix, recurrence, periode
            from temporalite RIGHT join evenement on temporalite.id=evenement.id_Temporalite
            where date>CURRENT_DATE
            ");

    $requete->execute();

    $listeEvenement = $requete->fetchAll(PDO::FETCH_CLASS);
    $listeEvenement = objectToArray($listeEvenement);






    if (empty($listeEvenement)) {
        echo "il n'y a aucun evenement";
    } else {
        $total = 0;
        foreach ($listeEvenement as $evenement) {

            var_dump($evenement);
            echo '<h4>' . $evenement['nom'] . '</h4>';
            ?>
            <button>participer</button>
            <button>détails</button>
    <?php
        }
    }


    ?>




</body>

</html>