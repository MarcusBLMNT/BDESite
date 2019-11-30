<?php
require 'bddconnect.php';
require '../public/api/jsonUnicode.php';
var_dump($_POST);
$bdd = bddConnect();
$reqPseudoNomCreateur = $bdd->prepare(
    "SELECT utilisateur.pseudo as pseudoCreateur, sujet.nom as nomSujet from sujet join utilisateur on sujet.id_utilisateur=utilisateur.id where sujet.id=:idsujet"
);
$reqPseudoNomCreateur->bindValue(':idsujet',  $_POST['sujet'], PDO::PARAM_INT);
$reqPseudoNomCreateur->execute();
$tab = $reqPseudoNomCreateur->fetchAll(PDO::FETCH_CLASS);
$tab = objectToArray($tab);
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="">

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
    <div id="repondre">
        <input type="text" id="reponse" placeholder="Répondre...">

        <script>
            function submit() {
                var reponse = document.getElementById('reponse');
                if (reponse.value != '') {
                    addNewComment(reponse.value, "<?php echo ($_SESSION['pseudo']) ?>", <?php echo ($_POST['sujet']) ?>);
                    reponse.value = '';

                }


            }
        </script>
        <button " onclick=" submit()">bouton</button>

    </div>
</body>

<script type="text/javascript" src="../public/js/sujet.js"></script>

</html>