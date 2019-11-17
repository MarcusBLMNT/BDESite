<?php
//script qui envoie à la base de données un nouveau evènement
include('../includes/bddConnect.php');
include('../public/api/jsonUnicode.php');
$bdd = bddConnect();



//si personne n'est connecté ou si la personne connectée n'est pas admin, redirection vers la page de connexion
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


if (isset($_POST) && !empty($_POST)) {

    //si la recurrence ==0, inserer null dans temporalité et 0 dans recurrence. sinon, inserer 1 dans reccurence et l'id_temporalité correspondante
    if ($_POST['recurrence'] == "0") {
        $requeteAddEvent = $bdd->prepare(
            "INSERT INTO `evenement` (`id`, `date`, `nom`, `description`, `url_image`, `prix`, `recurrence`, `id_Temporalite`)
         VALUES  
         (NULL,:date, :nom, :description, :image, :prix, 0,  NULL)"
        );
    } else {
        $requeteAddEvent = $bdd->prepare(
            "INSERT INTO `evenement` (`id`, `date`, `nom`, `description`, `url_image`, `prix`, `recurrence`, `id_Temporalite`)
         VALUES  
         (NULL,:date, :nom,:description, :image, :prix, 1,  :recurrence )"
        );
        $requeteAddEvent->bindValue(':recurrence', $_POST['recurrence'], PDO::PARAM_INT);
    }
    $requeteAddEvent->bindValue(':date',  $_POST['date'], PDO::PARAM_STR);
    $requeteAddEvent->bindValue(':nom',  $_POST['nom'], PDO::PARAM_STR);
    $requeteAddEvent->bindValue(':description', $_POST['description'], PDO::PARAM_STR);
    $requeteAddEvent->bindValue(':image', $_POST['image'], PDO::PARAM_STR);
    $requeteAddEvent->bindValue(':prix', $_POST['prix'], PDO::PARAM_STR);







    if ($requeteAddEvent->execute()) {
        echo ("evenement ajouté");
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
<!-- Formulaire permettant d'ajouter un évènement-->

<body>
    <div style="text-align:center">
        <form method="POST">

            <input type="text" name="nom" placeholder="Nom" required="required"><br>
            <input type="date" name="date" placeholder="Date" required="required"><br>

            <textarea name="description" rows="5" cols="33" required="required">
               Description
            </textarea><br>
            <input type="text" name="image" placeholder="image" required="required"><br>
            <input type="number" name="prix" placeholder="prix" required="required"><br>
            <label for="recurrence" aria-placeholder="recurence">recurence</label><br />
            <select name="recurrence">
                <option value="0">non</option>
                <option value="1">jour</option>
                <option value="2">semaine</option>
                <option value="3">mois</option>
                <option value="4">annee</option>
            </select><br>
            <input type="submit" value="envoyer">
        </form>
    </div>
</body>

</html>