<?php
require 'bddconnect.php';
require 'getStatut.php';

if (getStatut() == 0) {
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
    echo ("<br>Sujet Modifiée =)");
}
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Titre de la page</title>

</head>

<body>
    Modifie une catégorie
    <form method="POST">
        <select name="sujet">
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
        </select>
        <input type="text" name="nomsujet" placeholder="nouveau nom" required="required">
        <button type="submit">Modifier</button>

    </form>
</body>

</html>