<?php
session_start();
?>
<!doctype html>

<html lang="fr">



<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


</head>
<?php

include('../includes/header.php'); ?>

<div class="row">
    <div class="col-2" style="margin-left:0">
        <?php
        include('../includes/menu.php');
        ?>
    </div>
    <div class="col-10" style="margin-left:0">
        <form action="../script/scriptLike.php" method="post">
            <input type="submit" name="submit" value="Like" />
        </form>



    </div>




</div>

<?php
$bdd = new PDO(
    'mysql:host=localhost;dbname=projetweb;charset=utf8',
    'root',
    ''
);

$pseudo = "elise";
$req_any_cart = $bdd->prepare('CALL any_cart(:pseudo)');
$req_any_cart->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);

$req_any_cart->execute();
$table = array();
while ($data = $req_any_cart->fetch()) {
    $table[] = $data['id'];
}
$id_commande = $table[0];
echo $id_commande;

include('../includes/footer.html');

$req_any_cart->closeCursor();



?>



</html>