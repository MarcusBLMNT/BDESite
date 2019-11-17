<!doctype html>
<html lang="fr">


<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>BDE Cesi Bordeaux</title>
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
        include('../includes/accueil.html');


        echo ($tomorrow);


        ?>


    </div>
</div>


<?php
include('../includes/footer.html');





?>


</html>