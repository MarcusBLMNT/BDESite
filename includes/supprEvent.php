<?php

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


if (isset($_POST['id']) && !empty($_POST['id'])) {
    $requeteDelEvent1 = $bdd->prepare(
        "DELETE FROM evenementutilisateur WHERE id_evenement=:id"
    );
    $requeteDelEvent1->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
    $requeteDelEvent1->execute();

    $requeteDelEvent2 = $bdd->prepare(
        "DELETE FROM evenement WHERE id=:id"
    );
    $requeteDelEvent2->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
    if ($requeteDelEvent2->execute()) {
        echo ("evenement supprimé");
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

            <input type="number" name="id" placeholder="id" required="required"><br>

            <input type="submit" value="envoyer">
        </form>
    </div>
</body>

</html>