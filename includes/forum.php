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
            $reqMailsBde = $bdd->prepare("SELECT email from utilisateur where utilisateur.id_Role=2");
            $reqMailsBde->execute();
            $reqMailsBde = $reqMailsBde->fetchAll(PDO::FETCH_CLASS);
            $reqMailsBde = objectToArray($reqMailsBde);
            $reqSujetsDepl = $bdd->prepare("SELECT nom from sujet join signalesujet on sujet.id=signalesujet.id_Sujet");
            $reqSujetsDepl->execute();
            $reqSujetsDepl = $reqSujetsDepl->fetchAll(PDO::FETCH_CLASS);
            $reqSujetsDepl = objectToArray($reqSujetsDepl);
            $sujetsDepl = "";
            foreach ($reqSujetsDepl as $key => $sujet) {
                $sujetsDepl = $sujetsDepl . '%0D%0A- ' . utf8_encode($sujet['nom']);
            }
            $sujetsDepl = str_replace("?", "%3F", $sujetsDepl, $count);



            $mailsBDE = "";
            foreach ($reqMailsBde as  $key => $Mail) {
                if ($key > 0) {
                    $mailsBDE = $mailsBDE . ',';
                }
                $mailsBDE = $mailsBDE . $Mail['email'];
            }


            ?>

            <a href='mailto:<?php echo ($mailsBDE); ?>?subject=Attention!%20Commentaires%20ou%20sujets%20déplacés%20sur%20le%20site%20du%20BDE
            &body=Voici les différents sujets déplacés :<?php echo ($sujetsDepl) ?> %0D%0AVoici les différents messages déplacés %0D%0A- corpsMessage du sujet nomSujet%0D%0Aveuillez agir en conséquences svp Merci!'>notifier membres du bde</a>
        <?php
        }
        ?>
    </div>
    <div id="resultatAjax" class="row">

    </div>


</body>

<script type="text/javascript" src="../public/js/forum.js"></script>

</html>