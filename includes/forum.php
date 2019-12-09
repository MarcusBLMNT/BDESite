<?php
include('bddconnect.php');
$bdd = bddConnect();


?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Titre de la page</title>


</head>
<?php
require '../includes/getStatut.php'
?>
<?php
$statut = getStatut();
?>

<body onload="init(<?php
                    echo ($statut);
                    ?>)">
    <div id="boutonsAdmins">
        <?php
        if ($statut > 0) {
            ?>
            <a href="indexCreateSubject.php">créer sujet</a>
        <?php
        }
        ?>
        <?php
        if ($statut == 3) {
            ?>
            <a href="mailto:truc@aremplacer?subject=Attention!%20Commentaires%20ou%20sujets%20déplacés%20sur%20le%20site%20du%20BDE
            &body=Voici les différents sujets déplacés :%0D%0A - nomSujet %0D%0AVoici les différents messages déplacés %0D%0A- corpsMessage du sujet nomSujet%0D%0Aveuillez agir en conséquences svp Merci!">notifier membres du bde</a>
        <?php
        }
        ?>
    </div>
    <div id="resultatAjax" class="row">

    </div>


</body>

<script type="text/javascript" src="../public/js/forum.js"></script>

</html>