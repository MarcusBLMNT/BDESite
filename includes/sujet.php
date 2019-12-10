<?php
require 'bddconnect.php';
require 'getStatut.php';
$bdd = bddConnect();
if (!isset($_GET['sujet'])) {
    $_GET['sujet'] = 0;
}
$reqPseudoNomCreateur = $bdd->prepare(
    "SELECT utilisateur.pseudo as pseudoCreateur, sujet.nom as nomSujet, prive from sujet join utilisateur on sujet.id_utilisateur=utilisateur.id where sujet.id=:idsujet"
);
$reqPseudoNomCreateur->bindValue(':idsujet',  $_GET['sujet'], PDO::PARAM_INT);
$reqPseudoNomCreateur->execute();
$tab = $reqPseudoNomCreateur->fetchAll(PDO::FETCH_CLASS);
$tab = objectToArray($tab);
if (!empty($tab)) {
    if ($tab[0]['prive'] == 1 && getStatut() == 0) {
        header('Location:indexLogin.php');
        exit();
    }
} else {
    header('Location:indexLogin.php');
    exit();
}



?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../public/css/sujet.css">
    <script>
        function signalerMessage(idMessage, idUsr) {

            var xml = new XMLHttpRequest();
            xml.open('POST', 'js/para.php', true);
            xml.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xml.send('requete=signalerMessage&idMessage=' + idMessage + '&idUsr=' + idUsr);
            xml.onreadystatechange = function() {
                if (xml.readyState == 4) {
                    console.log("Message " + idMessage + " signalé par " + idUsr);
                }
            }
        }

        function signalerSujet(idSujet, idUsr) {

            var xml = new XMLHttpRequest();
            xml.open('POST', 'js/para.php', true);
            xml.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xml.send('requete=signalerSujet&idSujet=' + idSujet + '&idUsr=' + idUsr);
            xml.onreadystatechange = function() {
                if (xml.readyState == 4) {
                    console.log("Sujet " + idSujet + " signalé par " + idUsr);
                }
            }
        }

        function submit() {
            var reponse = document.getElementById('reponse');
            if (reponse.value != '') {
                addNewComment(reponse.value, "<?php echo ($_SESSION['pseudo']) ?>", "<?php echo ($_GET['sujet']) ?>", "<?php echo (getIdUser($_SESSION['pseudo'])) ?>");
                reponse.value = '';
            }
        }
    </script>
</head>

<body onload=refresh(<?php echo ($_GET['sujet']) ?>,<?php echo (getIdUser($_SESSION['pseudo'])) ?>)>

    <?php
    if (isset($_SESSION) && !empty($_SESSION)) {
        ?>
        <div id="body2" onkeydown="if(event.keyCode==13){ 
    submit();    
    }">
            <button onclick="signalerSujet(<?php echo ($_GET['sujet'] . ',' . getIdUser()); ?>)">signaler le sujet</button>
        <?php
        }
        ?>


        <div id=" HeaderSujet">
            <div id="titreSujet">
                <?php
                echo (utf8_encode($tab[0]['nomSujet']));
                ?>
            </div>
            <div id="pseudoCreateur">
                <?php
                echo ($tab[0]['pseudoCreateur']);
                ?>
            </div>
        </div>
        <div id="messages">

            <script>
                var div = document.getElementById('messages');
                div.scrollTop = div.scrollHeight - div.clientHeight;
            </script>
        </div>
        <div id="repondre">
            <?php
            if (!empty($_SESSION) && getStatut() > 0) {

                ?>
                <input type="text" id="reponse" placeholder="Répondre...">
                <button onclick="submit()">bouton</button>
            <?php
            } else {
                echo ("Vous devez être connecté pour envoyer des messages");
            }

            ?>

        </div>
        </div>
</body>

<script type="text/javascript" src="../public/js/sujet.js"></script>

</html>