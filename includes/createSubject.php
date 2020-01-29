<?php
require 'bddConnect.php';
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
    $requetePostSujet = $bdd->prepare("INSERT INTO `sujet` ( `nom`, `prive`, `id_categorie`, `id_utilisateur`) VALUES 
    ( :nom, :prive,:idCategorie, :idUtilisateur);
    ");
    $requetePostSujet->bindValue(':nom', utf8_decode($_POST['nom']), PDO::PARAM_STR);
    $requetePostSujet->bindValue(':prive', $_POST['privé'], PDO::PARAM_STR);
    $requetePostSujet->bindValue(':idCategorie', $_POST['categorie'], PDO::PARAM_STR);
    $requetePostSujet->bindValue(':idUtilisateur', getIdUser(), PDO::PARAM_STR);
    $requetePostSujet->execute();
    echo ("Sujet posté =)");
}
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Titre de la page</title>
    <link rel="stylesheet" href="../public/css/createSubject.css">
</head>

<body>
    <h2>Ajout d'un nouveau sujet</h2>
    <div class="test">
    <form method="POST">
        <table>
        <tr>
         <td>Sujet</td>
         <td><input type="text" name="nom" placeholder="nom" required="required" size="50"></td>
      </tr>
      <tr>
         <td>Catégorie</td>
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
      <tr>
         <td>Privé ?</td>
         <td><select name="privé">
            <option value="0">non</option>
            <option value="1">oui</option>
        </select></td>
      </tr>
  </table>
        <button type="submit">créer</button>

    </form>
</div>
</body>

</html>