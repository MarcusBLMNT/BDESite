<?php
require 'bddconnect.php';
$bdd = bddConnect();


?>



<?php
require '../includes/getStatut.php'
?>
<?php
$statut = getStatut();
if (isset($_POST['filtre']) && !empty($_POST['filtre'])) {
    $post = $_POST['filtre'];
} else {
    $post = 'NULL';
}
?>

<body onload="init(<?php
                    echo ($statut . ', \'' . $post . '\'');
                    ?>)">
    <div id="boutonsAdmins">

        <?php
        if ($statut > 0) {
        ?>
            <a href="indexCreateSubject.php">Créer sujet</a>

        <?php
        }
        if ($statut > 1) {
        ?>
            <a href="indexCreateCategorie.php">Créer catégorie</a>
            <a href="indexDeleteCategory.php">Supprimer une catégorie</a>
            <a href="indexUpdateCategory.php">Modifier une catégorie</a>
            <a href="indexDeleteSujet.php">Supprimer un sujet</a>
            <a href="indexUpdateSujet.php">Editer un sujet</a>
            <a href="indexBannir.php">Bannir un étudiant</a>
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
            $reqMessDepl = $bdd->prepare('SELECT message.corps, sujet.nom from signalemessage join message on signalemessage.id_message=message.id
             join sujet on message.id_sujet=sujet.id order by sujet.nom asc');
            $reqMessDepl->execute();
            $reqMessDepl = $reqMessDepl->fetchAll(PDO::FETCH_CLASS);
            $reqMessDepl = objectToArray($reqMessDepl);
            $messagesDepl = '';
            foreach ($reqMessDepl as $key => $message) {
                $messagesDepl = $messagesDepl . '-' . utf8_encode($message['corps']) . ' (' . utf8_encode($message['nom']) . ')%0D%0A';
            }
            $messagesDepl = str_replace(array("?", "'"), array("%3F", "%27"), $messagesDepl);



            $sujetsDepl = "";
            foreach ($reqSujetsDepl as $key => $sujet) {
                $sujetsDepl = $sujetsDepl . '%0D%0A- ' . utf8_encode($sujet['nom']);
            }
            $sujetsDepl = str_replace("?", "%3F", $sujetsDepl);



            $mailsBDE = "";
            foreach ($reqMailsBde as  $key => $Mail) {
                if ($key > 0) {
                    $mailsBDE = $mailsBDE . ',';
                }
                $mailsBDE = $mailsBDE . $Mail['email'];
            }


        ?>

            <a href='mailto:<?php echo ($mailsBDE); ?>?subject=Attention!%20Commentaires%20ou%20sujets%20déplacés%20sur%20le%20site%20du%20BDE
            &body=Voici les différents sujets déplacés :<?php echo ($sujetsDepl) ?> %0D%0AVoici les différents messages déplacés :%0D%0A%0D%0A<?php echo ($messagesDepl) ?>
            %0D%0AVeuillez agir en conséquences svp. Merci!%0D%0A%0D%0ALa direction'>Notifier membres du bde</a>
        <?php
        }
        ?>
    </div>
    <?php
    $requete = $bdd->prepare("SELECT * FROM `categoriesujet`");
    $requete->execute();
    $requete = $requete->fetchAll(PDO::FETCH_CLASS);
    $requete = objectToArray($requete);
    ?>
    <div id="filtre">
        <form method="POST">
            <select name="filtre">
                <?php
                foreach ($requete as $categorie) { ?>
                    <option value="<?php echo ($categorie['id']); ?>">
                        <?php
                        echo (utf8_encode($categorie['nom']));
                        ?>
                    </option>

                <?php
                }

                ?>
                <option value="NULL">Aucun filtre</option>
            </select>
            <button type="submit">filtrer</button>
    </div>
    <div id="resultatAjax" class="row">

    </div>


</body>
<script type="text/javascript" src="../public/js/forum.js"></script>

</html>