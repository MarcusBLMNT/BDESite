<?php

include('../includes/bddConnect.php');
include('../public/api/jsonUnicode.php');
$_SESSION["pseudo"] = "elise";
//$_SESSION['motDePasse'] = "mdp";
$bdd = bddConnect();
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


if (isset($_POST) && !empty($_POST)) {

    if ($_POST['recurrence'] != "0") {
        $recurrenceNull = 1;
    } else {
        $recurrenceNull = null;
    }





    $requeteAddEvent = $bdd->prepare(
        "INSERT INTO `evenement` (`id`, `date`, `nom`, `description`, `url_image`, `prix`, `recurrence`, `id_Temporalite`)
     VALUES  
     (NULL,\"" . $_POST['date'] . "\", \"" . $_POST['nom'] . "\", \"" . $_POST['description'] . "\", \"" . $_POST['image'] . "\",
    \"" . $_POST['prix'] . "\", \"" . $recurrenceNull . "\", \"" . $_POST['recurrence'] . "\")"
    );
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
                <option value=null>non</option>
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