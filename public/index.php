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
        <?php
        //inserez vos includes
        ?>


        <!--<form action="scriptZip.php" method="post">
            <input type="submit" name="submit" value="zip" />
        </form>-->
        <form action="../script/scriptZipInscrit.php" method="post">
            <input type="submit" name="submit" value="zip" />
        </form>
    </div>




</div>

<?php





include('../includes/footer.html');





?>


</html>