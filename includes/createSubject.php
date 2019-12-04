<?php
require 'bddconnect.php';
require 'getStatut.php';

if (getStatut() == 0) {
    header('Location:indexLogin.php');
    exit();
}
$bdd = bddConnect();
$requete = $bdd->prepare("SELECT * FROM `categoriesujet`");
$requete->execute();
$requete = $requete->fetchAll(PDO::FETCH_CLASS);
$requete = objectToArray($requete);

if (isset($_POST) && !empty($_POST)) {

    echo ("Sujet posté");
    var_dump($_POST);
}
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Titre de la page</title>

</head>

<body>
    <form method="POST">
        <input type="text" name="nom" placeholder="nom" required=>
        <select name="categorie">
            <?php
            foreach ($requete as $categorie) { ?>
                <option value="<?php echo ($categorie['id']); ?>">
                    <?php
                        echo ($categorie['nom']);
                        ?>
                </option>
            <?php
            }

            ?>
        </select>



        <select name="privé">
            <option value="0">non</option>
            <option value="1">oui</option>
        </select><br>
        <button type="submit">créer</button>

    </form>
</body>

</html>