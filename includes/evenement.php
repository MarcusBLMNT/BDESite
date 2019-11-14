<?php

include('../includes/bddConnect.php');
include('../public/api/jsonUnicode.php');





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
    if (isset($_SESSION["pseudo"])) {
        $requeteAdmin = $bdd->prepare("SELECT role.id from utilisateur 
    join role on utilisateur.id_Role=role.id where utilisateur.pseudo=\"" . $_SESSION["pseudo"] . "\"
    ");
        $requeteAdmin->execute();
        $idAdmin = $requeteAdmin->fetchAll(PDO::FETCH_CLASS);
        $idAdmin = objectToArray($idAdmin);
    } else {
        $idAdmin[0]["id"] = "2";
    }

    $requete = $bdd->prepare("SELECT date , nom, description, url_image, prix, recurrence, periode
            from temporalite RIGHT join evenement on temporalite.id=evenement.id_Temporalite
            where date>=CURRENT_DATE order by date ASC
            ");
    $requete2 = $bdd->prepare("SELECT date , nom, description, url_image, prix, recurrence, periode
    from temporalite RIGHT join evenement on temporalite.id=evenement.id_Temporalite
    where date<CURRENT_DATE order by date DESC
    ");

    $requete2->execute();

    $requete->execute();


    $listeEvenement = $requete->fetchAll(PDO::FETCH_CLASS);
    $listeEvenement = objectToArray($listeEvenement);
    $listeEvenementPasses = $requete2->fetchAll(PDO::FETCH_CLASS);
    $listeEvenementPasses = objectToArray($listeEvenementPasses);







    ?>
    <div>
        <?php
        if (!empty($idAdmin)) {

            if ($idAdmin[0]["id"] == "1" || $idAdmin[0]["id"] == "3") {

                ?>
                <a href="../public/indexAddEvent.php"><button>Ajouter evenement</button></a>
                <button>Supprimer evenement</button>
        <?php
            }
        }

        ?>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h2> Evenement en cours</h2>
            <?php

            if (empty($listeEvenement)) {

                echo "il n'y a aucun evenement en cours";
            } else {
                foreach ($listeEvenement as $evt) {
                    printEvt($evt);
                    if (isset($_SESSION["pseudo"])) {
                        ?>
                        <a href=""><button>participer</button></a>
            <?php
                    }
                }
            }

            ?>

        </div>
        <div class="col-md-6">
            <h2> Evenement Passés</h2>
            <?php

            if (empty($listeEvenementPasses)) {

                echo "il n'y a aucun evenement Passé";
            } else {
                foreach ($listeEvenementPasses as $evtP) {
                    printEvt($evtP);
                    ?>
                    <a href=""><button>souvenirs</button></a>
            <?php
                }
            }

            ?>

        </div>
    </div>





</body>

</html>
<?php
function printEvt($e)
{
    $return = '';


    $return = $return . '<br><br><h4>' . $e['nom'] . '</h4></br>' . $e['url_image'] . '</br> ' . $e['description'] . ' </br>' . $e['prix'] . ' €</br>' .  $e['date'] . '</br>';
    if ((int) $e['recurrence'] == 1) {
        $return = $return . 'Nouvel evenement chaque ' . $e['periode'] . '</br>';
    }


    echo $return;
}
?>