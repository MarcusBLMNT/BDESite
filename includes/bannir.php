<?php
require 'bddconnect.php';
require 'getStatut.php';

if (getStatut() == 0) {
    header('Location:indexLogin.php');
    exit();
}
$bdd = bddConnect();
$bdd = bddConnect();
$requete = $bdd->prepare("SELECT id, pseudo, banni FROM `utilisateur`");
$requete->execute();
$requete = $requete->fetchAll(PDO::FETCH_CLASS);
$requete = objectToArray($requete);

if (isset($_POST) && !empty($_POST)) {
    $requeteDeleteCategory = $bdd->prepare("UPDATE `utilisateur` SET `banni` = :banni  WHERE `utilisateur`.`id` = :idUtilisateurs;");

    $requeteDeleteCategory->bindValue(':idUtilisateurs', $_POST['utilisateur'], PDO::PARAM_STR);
    $requeteDeleteCategory->bindValue(':banni', $_POST['banni'], PDO::PARAM_STR);
    $requeteDeleteCategory->execute();
    if ($_POST['banni'] == 1) {
        echo ("L'utilisateur a bien été banni<br>");
    } else {
        echo ("<br>L'utilisateur n'est pas banni<br>");
    }
}
?>

<!doctype html>
<html lang="fr">
<head>
<link rel="stylesheet" href="../public/css/bannir.css">
</head>
<body>
    <h2>Bannir un utilisateur</h2>
    <form method="POST">
        <table>
        <tr>
         <td><select name="utilisateur">
            <?php
            foreach ($requete as $utilisateur) { ?>
                <option value="<?php echo ($utilisateur['id']); ?>">
                    <?php

                    echo (utf8_encode($utilisateur['pseudo']));
                    if ($utilisateur['banni'] == 1) {
                        echo (" (banni)");
                    }
                    ?>
                </option>
            <?php
            }

            ?>
        </select>

        <select name="banni">

            <option value="1">oui</option>
            <option value="0">non</option>

        </select></td>
      </tr>
  </table>
        <button type="submit">Bannir</button>
    </form>
</body>
</html>