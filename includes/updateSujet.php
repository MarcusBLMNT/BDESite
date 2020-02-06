<?php
require 'bddconnect.php';
require 'getStatut.php';

if (getStatut() < 2) {
    header('Location:indexLogin.php');
    exit();
}
$bdd = bddConnect();
$bdd = bddConnect();
$requete = $bdd->prepare("SELECT * FROM `sujet`");
$requete->execute();
$requete = $requete->fetchAll(PDO::FETCH_CLASS);
$requete = objectToArray($requete);

if (isset($_POST) && !empty($_POST)) {
    $requeteDeleteCategory = $bdd->prepare("UPDATE `sujet` SET `nom` = :nomsujet  WHERE `sujet`.`id` = :idsujet;");

    $requeteDeleteCategory->bindValue(':idsujet', $_POST['sujet'], PDO::PARAM_STR);
    $requeteDeleteCategory->bindValue(':nomsujet', utf8_decode($_POST['nomsujet']), PDO::PARAM_STR);
    $requeteDeleteCategory->execute();
    echo ("<br>Sujet Modifié");
}
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Titre de la page</title>
<link rel="stylesheet" href="../public/css/updateSubject.css">
</head>
<body>
    <h2>Modifier un sujet</h2>
    <form method="POST">
        <table>
        <tr>
         <td><select name="sujet">
            <?php
            foreach ($requete as $sujet) { ?>
                <option value="<?php echo ($sujet['id']); ?>">
                    <?php
                                echo (utf8_encode($sujet['nom']));
                    ?>
                </option>
            <?php
                            }

            ?>
        </select></td>
      </tr>
  </table>
        <input type="text" name="nomsujet" placeholder="Nouveau nom" required="required">
        <button type="submit">Modifier</button>
    </form>
</body>
</html>