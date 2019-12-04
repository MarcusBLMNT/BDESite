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
</head>

<body onkeydown="if(event.keyCode==13){ 
    submit();    
    }">



    <div id=" HeaderSujet">
        <div id="titreSujet">
            <?php
            echo ($tab[0]['nomSujet']);
            ?>
        </div>
        <div id="pseudoCreateur">
            <?php
            echo ($tab[0]['pseudoCreateur']);
            ?>
        </div>
    </div>
    <div id="messages">
        <?php
        $reqmsg = $bdd->prepare("SELECT message.date as datemsg, corps, utilisateur.pseudo
from message join sujet on message.id_sujet=sujet.id join utilisateur on message.id_utilisateur=utilisateur.id where sujet.id=:sujetId order by datemsg ASC");

        $reqmsg->bindValue(':sujetId', $_GET['sujet'], PDO::PARAM_INT);
        $reqmsg->execute();
        $reqmsg = $reqmsg->fetchAll(PDO::FETCH_CLASS);
        $reqmsg = objectToArray($reqmsg);
        foreach ($reqmsg as $message) {
            ?>
            <div class="message">
                <?php
                    echo ($message['datemsg'] . ' ' . $message['corps'] . ' (' . $message['pseudo'] . ')');

                    ?>
            </div>

        <?php
        }
        ?>
        <script>
            var div = document.getElementById('messages');
            div.scrollTop = div.scrollHeight - div.clientHeight;
        </script>
    </div>
    <div id="repondre">
        <?php
        if (!empty($_SESSION)) {
            ?>
            <input type="text" id="reponse" placeholder="Répondre...">

            <script>
                function submit() {
                    var reponse = document.getElementById('reponse');
                    if (reponse.value != '') {
                        addNewComment(reponse.value, "<?php echo ($_SESSION['pseudo']) ?>", <?php echo ($_GET['sujet']) ?>);
                        reponse.value = '';

                    }


                }
            </script>
            <button onclick=" submit()">Envoyer</button>
        <?php
        } else {
            ?>
            Vous devez être connecté afin d'envoyer des messages...
        <?php
        }
        ?>
    </div>
</body>

<script type="text/javascript" src="../public/js/sujet.js"></script>

</html>