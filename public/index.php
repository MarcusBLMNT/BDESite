<?php

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
        <form action="../script/scriptAjoutPanier.php" method="post">
            <input type="submit" name="submit" value="Ajouter" />
        </form>



    </div>




</div>

<?php
$bdd = new PDO(
    'mysql:host=localhost;dbname=projetweb;charset=utf8',
    'root',
    ''
);
$id_commande = 5;
$idarticle = 2;


$req_is_article_already_in = $bdd->prepare('CALL is_article_already_in(:id_article, :id_commande)');
$req_is_article_already_in->bindValue(':id_commande', $id_commande, PDO::PARAM_STR);
$req_is_article_already_in->bindValue(':id_article', $idarticle, PDO::PARAM_STR);

$req_is_article_already_in->execute();

$table2 = array();
while ($data = $req_is_article_already_in->fetch()) {
    $table2[] = $data['quantite'];
}
echo $table2[0];

$req_is_article_already_in->closeCursor();

include('../includes/footer.html');




?>



</html>