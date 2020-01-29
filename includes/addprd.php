<?php
//script permettant d'ajouter des articles dans la base de données
try {
    $bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    echo "Erreur:" . $e;
}


if (isset($_POST['Ajouter'])) {

    $Nom = htmlentities(trim($_POST['nom']));
    $description = htmlentities(trim($_POST['description']));
    $image = htmlentities(trim($_POST['urlimage']));
    $prix = htmlentities(trim($_POST['prix']));
    $stock = htmlentities(trim($_POST['stock']));
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

    <!-- Formulaire pour ajouter un article-->
    <div class="inscrip">


        <?php if (isset($_POST['Ajouter']) and isset($return)) echo $return; ?>
        <form method="POST" action="addprd.php">
            <h2 style="color: white">Ajouter Article</h2>
            <input type="text" name="nom" placeholder="nom"><br><br>
            <input type="text" name="description" placeholder="description"><br><br>
            <input type="image" name="urlimage" placeholder="image"><br><br>


            <input type="text" name="prix" placeholder="adresse mail"> <br><br>
            <input type="password" name="stock" placeholder="Mot de passe"><br><br>

            <br><br><input type="submit" name="Ajouter" value="Ajouter">
        </form>
    </div>
</body>

</html>