<!doctype html>
<html lang="fr">


<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Titre de la page</title>



</head>
<?php

include('../includes/headerOn.html'); ?>

<div class="row">

    <div class="col-md-2" style="margin-left:0">
        <?php
        include('../includes/menu.php');
        ?>
    </div>
    <div class="col-md-10" style="margin-left:0">
        <?php

        include('../includes/panier.php');


        ?>


    </div>
</div>


<?php
include('../includes/footer.html');





?>


</html>