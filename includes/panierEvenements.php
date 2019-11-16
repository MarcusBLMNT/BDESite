<?php

include('../public/api/jsonUnicode.php');
include('bddConnect.php');


if (
    !isset($_SESSION['pseudo'])  ||
    empty($_SESSION['pseudo'])
) {
    header('Location:indexAccueil.php');
    exit();
} else {

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


        $requete = $bdd->prepare("SELECT evenement.nom, date from utilisateur
            join evenementutilisateur on utilisateur.id=evenementutilisateur.id_Utilisateur
            join evenement on evenementutilisateur.id_evenement= evenement.id where pseudo=:pseudo and
            date >= CURRENT_DATE order by date desc");
        $requete->bindValue(':pseudo', $_SESSION['pseudo'], PDO::PARAM_STR);


        $requete->execute();

        $contenuPanier = $requete->fetchAll(PDO::FETCH_CLASS);
        $contenuPanier = objectToArray($contenuPanier);







        if (empty($contenuPanier)) {
            echo "Vous ne participez a aucun evenement a venir";
        } else {
            foreach ($contenuPanier as $article) {

                echo ("<div style=\"font-weight: bold\">" . $article['nom'] . "</div>le " . $article['date'] . "<br>");
            }
        }
    }


    ?>




    </body>

    </html>