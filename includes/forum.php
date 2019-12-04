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
        ?> </div>
    <div id="resultatAjax" class="row">

    </div>


</body>

<script type="text/javascript" src="../public/js/forum.js"></script>

</html>