<?php
include('bddconnect.php');
include('../public/api/jsonUnicode.php');
$bdd = bddconnect();
var_dump($_POST);
if (isset($_POST['inscription'])) {
    //récupération des données inscrites par l'utilisateur
    $nom = htmlentities(trim($_POST['Nom']));
    $prenom = htmlentities(trim($_POST['Prenom']));
    $pseudo = htmlentities(trim($_POST['Pseudo']));
    $email = htmlentities(trim($_POST['email']));
    $localisation = htmlentities(trim($_POST['localisation']));
    $mdp = htmlentities(trim($_POST['Mdp']));
    $mdp2 = htmlentities(trim($_POST['Mdp2']));



    //vérification des données
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if ($mdp == $mdp2) {

            if (strlen($nom) <= "50") {

                $testEmail = $bdd->prepare("SELECT id FROM utilisateur WHERE email =:email");
                $testEmail->bindValue(':email',  $email, PDO::PARAM_STR);
                $testEmail->execute();
                $TabTestEmail = $testEmail->fetchAll(PDO::FETCH_CLASS);
                $TabTestEmail = objectToArray($TabTestEmail);
                if (empty($TabTestEmail)) {
                    //      var_dump($TabTestEmail);
                    $testEmail2 = $bdd->prepare(" INSERT INTO utilisateur(pseudo, mot_de_passe, email, prenom, nom, id_role, id_localisation_centre)
                    VALUES (:pseudo, :mdp, :email, :prenom, :nom, '1', :localisation) ");
                    //    changer la procedure add_user 
                    $testEmail2->bindValue(':pseudo',  $pseudo, PDO::PARAM_STR);
                    $testEmail2->bindValue(':mdp',  $mdp, PDO::PARAM_STR);
                    $testEmail2->bindValue(':email',  $email, PDO::PARAM_STR);
                    $testEmail2->bindValue(':localisation',  $localisation, PDO::PARAM_STR);
                    $testEmail2->bindValue(':nom',  $nom, PDO::PARAM_STR);
                    $testEmail2->bindValue(':prenom',  $prenom, PDO::PARAM_STR);
                    $testEmail2->execute();
                } else {
                    echo ("vous possedez déjà un compte");
                }
            } else $return = "Depasse 50 caract";
        } else $return = "Veuillez renseignez des mots de passe identique ";
    } else $return = "L'email est invalide";
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
    <div class="inscrip">


        <?php if (isset($_POST['inscription']) and isset($return)) echo $return; ?>
        <form method="POST" action="indexInscription.php">
            <h2 style="color: white">Inscription</h2>
            <input type="text" name="Nom" placeholder="Nom" required="required"><br><br>
            <input type="text" name="Prenom" placeholder="Prénom" required="required"><br><br>
            <div name="genre">
                <label for="le_nom" required="required">Centre Cesi</label><br />
                <select name="localisation" id="le_nom">
                    <option value="4">Bordeaux</option>
                    <option value="20">Pau</option>
                    <option value="22">Rouen</option>
                    <option value="1">Aix-en-provence</option>

                </select>
            </div> <br>
            <input type="text" name="Pseudo" placeholder="Pseudo" required="required"><br><br>


            <input type="text" name="email" placeholder="adresse mail" required="required"> <br><br>
            <input type="password" name="Mdp" placeholder="Mot de passe" required="required"><br><br>
            <input type="password" name="Mdp2" placeholder="Confirmation du mot de passe" required="required"><br><br>
            <a href="../public/cgv.php">Acceptez les condition génerales</a><br><input type="checkbox" name="cocher" required="required">
            <br><br><input type="submit" name="inscription" value="M'inscrire">
        </form>
    </div>
</body>

</html>