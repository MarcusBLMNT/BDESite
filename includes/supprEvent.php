<?php
//script supprimant un évenènement
include('../includes/bddConnect.php');
include('../public/api/jsonUnicode.php');
$bdd = bddConnect();
if (!empty($_SESSION["pseudo"])) {

    $requeteAdmin = $bdd->prepare("SELECT role.id from utilisateur 
join role on utilisateur.id_Role=role.id where utilisateur.pseudo=\"" . $_SESSION["pseudo"] . "\"
");
    $requeteAdmin->execute();
    $idAdmin = $requeteAdmin->fetchAll(PDO::FETCH_CLASS);
    $idAdmin = objectToArray($idAdmin);
    if (empty($idAdmin)) {
        header('Location:indexLogin.php');
        exit();
    } elseif ($idAdmin[0]["id"] != "1" && $idAdmin[0]["id"] != "3") {
        header('Location:indexLogin.php');
        exit();
    }
} else {
    header('Location:indexLogin.php');
    exit();
}


if (isset($_POST['nom']) && !empty($_POST['nom'])) {
    $selectId = $bdd->prepare("SELECT id from evenement where nom=:nom");
    $selectId->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);
    $selectId->execute();
    $selectIdRes = $selectId->fetchAll(PDO::FETCH_CLASS);
    $selectIdRes = objectToArray($selectIdRes);
    if (!empty($selectIdRes)) {


        $requeteDelEvent1 = $bdd->prepare(
            "DELETE FROM evenementutilisateur WHERE id_evenement=:id"
        );
        $requeteDelEvent1->bindValue(':id', $selectIdRes[0]['id'], PDO::PARAM_INT);
        $requeteDelEvent1->execute();


        $requeteDelEvent2 = $bdd->prepare(
            "DELETE FROM evenement WHERE nom =:nom"
        );
        $requeteDelEvent2->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);
        if ($requeteDelEvent2->execute()) {
            echo ("evenement supprimé");
        }
        $truc = $requeteDelEvent2->fetchAll(PDO::FETCH_CLASS);
        $truc = objectToArray($truc);
    } else {
        echo ("cet evenement n'existe pas...");
    }
}




?>
<!doctype html>

<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Titre de la page</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <div style="text-align:center">
        <form method="POST">

            <input type="text" name="nom" placeholder="nom" required="required"><br>

            <input type="submit" value="envoyer">
        </form>
    </div>
</body>

</html>