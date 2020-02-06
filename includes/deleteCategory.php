<?php
require 'bddconnect.php';
require 'getStatut.php';

if (getStatut() < 2) {
    header('Location:indexLogin.php');
    exit();
}
$bdd = bddConnect();
$requete = $bdd->prepare("SELECT * FROM `categoriesujet`");
$requete->execute();
$requete = $requete->fetchAll(PDO::FETCH_CLASS);
$requete = objectToArray($requete);

if (isset($_POST) && !empty($_POST)) {
    $requeteDeleteCategory = $bdd->prepare("DELETE FROM categoriesujet where categoriesujet.id=:idCategorie ");

    $requeteDeleteCategory->bindValue(':idCategorie', $_POST['categorie'], PDO::PARAM_STR);
    $requeteDeleteCategory->execute();
    echo ("<br>Catégorie supprimée");
}
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Titre de la page</title>
<link rel="stylesheet" href="../public/css/deleteCategory.css">
</head>

<body>
    <h2>Supprimer une catégorie</h2>
    <form method="POST">
        <table>
        <tr>
         <td><select name="categorie">
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
        </select></td>
      </tr>
  </table>
        <button type="submit">Supprimer</button>
    </form>
</body>
</html>