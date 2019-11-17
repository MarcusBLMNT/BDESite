<?php

include('../includes/bddConnect.php');
include('../public/api/jsonUnicode.php');
include('../script/scriptRecurrenceEvt.php');





?>
<!doctype html>

<html lang="fr">
<!-- page gérant l'affichage des évènements avec récupération dans la bdd -->

<head>
    <meta charset="utf-8">
    <title>Titre de la page</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <?php

    $bdd = bddConnect();
    //fait marcher la recurrence des événements
    recurrence();
    //si le role n'est pas déterminé, applique automatiquement le role de l'étudiant
    if (isset($_SESSION["pseudo"])) {
        $requeteAdmin = $bdd->prepare("SELECT role.id from utilisateur 
    join role on utilisateur.id_Role=role.id where utilisateur.pseudo=:pseudo
    ");
        $requeteAdmin->bindValue(':pseudo', $_SESSION["pseudo"], PDO::PARAM_STR);
        $requeteAdmin->execute();
        $idAdmin = $requeteAdmin->fetchAll(PDO::FETCH_CLASS);
        $idAdmin = objectToArray($idAdmin);
    } else {
        $idAdmin[0]["id"] = "2";
    }

    $requete = $bdd->prepare("SELECT  evenement.id, date , nom, description, url_image, prix, recurrence, periode
            from temporalite RIGHT join evenement on temporalite.id=evenement.id_Temporalite
            where date>=CURRENT_DATE order by date ASC
            ");
    $requete2 = $bdd->prepare("SELECT evenement.id, date, nom, description, url_image, prix, recurrence, periode
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
                <a href="../public/indexSupprEvent.php"><button>Supprimer evenement</button></a>
        <?php
            }
        }

        ?>
    </div>
    <form method="POST">
        <div class="row">
            <div class="col-md-6">

                <h2> Evenement a venir</h2>
                <?php

                if (empty($listeEvenement)) {
                    echo "il n'y a aucun evenement en cours";
                } else {
                    foreach ($listeEvenement as $evt) {


                        printEvt($evt);

                        if (isset($_SESSION["pseudo"])) {
                            ?>
                            <div onclick=<?php participer($bdd) ?>>
                                <button type=submit name="participer" value=<?php echo ($evt['id']) ?>>
                                    participer
                                </button></div>
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
    </form>





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

function participer($bdd)
{
    if (!isset($_POST['participer'])) {
        $_POST['participer'] = 0;
    }

    //récupère l'id de l'utilisateur
    $requeteIdUt = $bdd->prepare("SELECT id from utilisateur where utilisateur.pseudo=:pseudo");

    $requeteIdUt->bindValue(':pseudo', $_SESSION['pseudo'], PDO::PARAM_STR);
    $requeteIdUt->execute();
    $idUt = $requeteIdUt->fetchAll(pdo::FETCH_CLASS);
    $idUt = objectToArray($idUt);

    //si l'utilisateur est déjà inscrit, afficher : vous participez déjà à cet evenement
    if (isset($idUt)) {
        $requeteInscr = $bdd->prepare("SELECT * from evenementutilisateur where id_Utilisateur =:idUtilisateur and id_Evenement=:idEvenement");
        $requeteInscr->bindValue(':idUtilisateur', $idUt[0]['id'], PDO::PARAM_INT);
        $requeteInscr->bindValue(':idEvenement', $_POST['participer'], PDO::PARAM_INT);
        $requeteInscr->execute();
        $idInscr = $requeteInscr->fetchAll(pdo::FETCH_CLASS);
        $idInscr = objectToArray($idInscr);



        if (empty($idInscr)) {



            $requeteParticiper = $bdd->prepare("INSERT INTO `evenementutilisateur` (`id_evenement`, `id_Utilisateur`) VALUES (:idEvenement, :idUtilisateur);");
            $requeteParticiper->bindValue(':idUtilisateur', $idUt[0]['id'], PDO::PARAM_INT);
            $requeteParticiper->bindValue(':idEvenement', $_POST['participer'], PDO::PARAM_INT);
            $requeteParticiper->execute();
        }
    } else {
        header('location=../public/indexAccueil.php');
        exit();
    }
}




?>