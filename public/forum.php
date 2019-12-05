<!doctype html>
<html lang="fr">

<!-- page du forum-->

<head>
    <title>Forum</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<?php
include('../includes/header.php'); ?>

<div class="row">

    <div class="col-md-2" style="margin-left:0">
        <?php
        include('../includes/menu.php');
        ?>
    </div>
    <div class="col-md-10" style="margin-left:0">

        <?php
        include('../includes/bddConnect.php');
        $bdd = bddConnect();
        $pseudo = $_SESSION['pseudo'];
        $req = $bdd->prepare('call isbanned(:pseudo)');
        $req->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
        $req->execute();
        if ($req->fetch() != NULL) {

            echo '<form action="../includes/NewPost.php">
            <input type="submit">
            </form>';
        }
        include('../includes/forum.php');

        ?>








    </div>
</div>


<?php
include('../includes/footer.html');
?>


</html>