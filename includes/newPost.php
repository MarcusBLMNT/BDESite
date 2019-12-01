<form action="../script/scriptNewPost.php" method="post">
    <p>Titre : <input type="text" name="nom"></p>
    <p>Contenu de votre post : <input type="textarea" name="description"></p>

    <p>Dans quelle catégorie votre post s'inscrit ?
        <select name="choix">
            <?php
            include('../includes/bddConnect.php');
            $bdd = bddConnect();
            $req = $bdd->prepare("call list_cat()");
            $req->execute();
            while ($data = $req->fetch()) {
                echo '<option value="' . $data['nom'] . '">' .  $data['nom'] . '</option>';
            }
            ?>
        </select>
    </p>
    <input type="submit">
</form>