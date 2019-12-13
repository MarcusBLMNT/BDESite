<?php
require 'bddconnect.php';
require 'getStatut.php';

if (getStatut() == 0) {
    header('Location:indexLogin.php');
    exit();
}
$bdd = bddConnect();
$bdd = bddConnect();
$requete = $bdd->prepare("SELECT id, nom FROM `sujet`");
$requete->execute();
$requete = $requete->fetchAll(PDO::FETCH_CLASS);
$requete = objectToArray($requete);

if (isset($_POST) && !empty($_POST)) {
    $requeteDeleteSujet = $bdd->prepare("DELETE FROM sujet where sujet.id=:idSujet ");

    $requeteDeleteSujet->bindValue(':idSujet', $_POST['sujet'], PDO::PARAM_STR);
    $requeteDeleteSujet->execute();
    echo ("<br>Sujet supprimé =)");
}
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Titre de la page</title>

</head>

<body>
    Supprimes une catégorie
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
        <button type="submit">Supprimer</button>

    </form>
</body>

</html>