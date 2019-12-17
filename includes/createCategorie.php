<?php
require 'bddconnect.php';
require 'getStatut.php';

if (getStatut() == 0) {
    header('Location:indexLogin.php');
    exit();
}
$bdd = bddConnect();


if (isset($_POST) && !empty($_POST)) {
    $requeteCreateCategorie = $bdd->prepare("INSERT INTO `categoriesujet` (`nom`) VALUES (:nomCategorie);");

    $requeteCreateCategorie->bindValue(':nomCategorie', utf8_decode($_POST['nomCatégorie']), PDO::PARAM_STR);
    $requeteCreateCategorie->execute();
    echo ("<br>Catégorie '" . $_POST['nomCatégorie'] . "' créee  =)");
}
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Titre de la page</title>

</head>

<body>
    créez votre nouvelle catégorie
    <form method="POST">
        <input type="text" name="nomCatégorie" placeholder="nomCatégorie" required="required">
        <button type="submit">créer</button>
    </form>
</body>

</html>