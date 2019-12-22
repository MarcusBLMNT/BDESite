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
    echo ('<img src="images/paulok.png" style="width:200px">');
    if ($_POST['banni'] == 1) {
        echo ("<br>Ah bah bravo! JESPAIR QUEUE T FIèR DE TOUA 1? JTAVé pourten di ke CT PAS BI1 Mé bi1 sur ten fat KA TA TET COM DABITUD<br>");
    } else {
        echo ("<br>BON CAVA T JANTY. CA ve dir ke T PA MéCHAN. FO VRéMEN TOU TEXPLIKé GRO ***poney*** EH FRENCHEMEN TU M' *** m'amuses beaucoup. Et tu sens très bon la lavande fraiche*** EH je *** dis bonjour à*** ta *** baleine , merde l'extension...***<br>");
    }
}
?>

<!doctype html>
<html lang="fr">



<body>
    Bannis des utilisateurs pas polis! mEmME sy Sé pA tRAi JaNTY!!!!!!!!!!
    <form method="POST">
        <select name="utilisateur">
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

        </select>
        <button type="submit">Modifier</button>

    </form>
</body>

</html>