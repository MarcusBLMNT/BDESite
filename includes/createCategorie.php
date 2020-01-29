<?php
require 'bddconnect.php';
require 'getStatut.php';

if (getStatut() < 2) {
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
    <link rel="stylesheet" href="../public/css/createCategorie.css">
</head>

<body>
    <h2>Ajout d'une nouvelle catégorie</h2>
    <form method="POST">
        <table>
        <tr>
         <td><input type="text" name="nomCatégorie" placeholder="Nom de votre catégorie" required="required"></td>
      </tr>
  </table>
        <button type="submit">créer</button>
    </form>
</body>

</html>