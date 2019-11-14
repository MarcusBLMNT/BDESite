<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    echo "Erreur:" . $e;
}


if (isset($_POST['inscription'])) {

    $Nom = htmlentities(trim($_POST['Nom']));
    $Prenom = htmlentities(trim($_POST['Prenom']));
    $Pseudo = htmlentities(trim($_POST['Pseudo']));
    $email = htmlentities(trim($_POST['email']));
    $localisation = htmlentities(trim($_POST['localisation']));
    $Mdp = htmlentities(trim($_POST['Mdp']));
    $Mdp2 = htmlentities(trim($_POST['Mdp2']));
    //$genre = htmlentities(trim($_POST['genre']));
    if (!empty($Nom) and !empty($Prenom) and !empty($email) and !empty($Mdp) and !empty($Mdp2)) {
        if (isset($_POST['cocher'])) { } else $return = "Veuillez accepter les conditions générales";
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if ($Mdp == $Mdp2) {

                if (strlen($Nom) <= "50") {
                    $TestEmail = $bdd->query('SELECT id FROM utilisateurs WHERE email ="' . $email . '"');
                    if ($TestEmail->rowCount() < 1) {
                        $bdd->query('INSERT INTO utilisateurs (pseudo,mot_de_passe,email) VALUES ("' . $Pseudo . '","' . $Mdp . '","' . $email . '")');
                    }
                } else $return = "Depasse 50 caract";
            } else $return = "Veuillez renseignez des mots de passe identique ";
        } else $return = "L'email est invalide";
    } else $return = "Un ou plusieurs champs manquant";
}
?>


<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title Connexion></title>
    <link href="../public/css/inscrp.css" rel="stylesheet" />

    <link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
</head>


<body>
    <header>
        <?php
        include('../includes/headerOff.html');
        //include('../includes/menu.php');
        ?>
    </header>
    <div class="inscrip">


        <?php if (isset($_POST['inscription']) and isset($return)) echo $return; ?>
        <form method="POST" action="inscription.php">
            <h2 style="color: white">Inscription</h2>
            <input type="text" name="Nom" placeholder="Nom"><br><br>
            <input type="text" name="Prenom" placeholder="Prénom"><br><br>
            <input type="text" name="Pseudo" placeholder="Pseudo"><br><br>
            <input type="text" name="email" placeholder="adresse mail"> <br><br>
            <input type="password" name="Mdp" placeholder="Mot de passe"><br><br>
            <input type="password" name="Mdp2" placeholder="Confirmation du mot de passe"><br><br>
            Acceptez les condition génerales<input type="checkbox" name="cocher">
            <input type="submit" name="inscription" value="M'inscrire">
        </form>
    </div>
</body>

</html>