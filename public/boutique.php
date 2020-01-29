<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../public/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="font-awsome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../public/css/boutique.css">
    <script src="..public/assets/autocomplete/autocomplete-0.3.0.min.js"></script>
    <link rel="stylesheet" href="..public/assets/autocomplete/autocomplete-0.3.0.min.css">
    <link rel="stylesheet" href="...public/assets/OwlCarousel2-2.3.4/dis/assets/owl.carousel.css">
    <link rel="stylesheet" href="..public/assets/OwlCarousel2-2.3.4/dis/assets/owl.theme.default.css">
    <script src="..public/assets/OwlCarousel2-2.3.4/dis/assets/owl.carousel.js"></script>
    <link rel="stylesheet" href="..public/assets/productslider.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>


<title>Hello, world!</title>
</head>

<body>
    <header>
        <?php
        include('../includes/headerOn.php');
        ?>

    </header>



    <?php $article = $DB->query('SELECT * FROM article'); ?>
    <?php foreach ($article as $articles) : ?>
        <div class="container mt-s">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <img src="../public/images/<?php echo $articles->urlimage;  ?>" class="card-img-top">
                        <div class="card-body">

                            <?php echo $articles->nom;  ?><br>
                            <?php echo $articles->description; ?>


                            <?php echo $articles->prix; ?>
                            <button class="btn btn-danger"><i class="fa fa-cart-plus" aria-heden="true"></i>Ajouter au panier</button>
                        </div>
                    </div>

                </div>



            </div>
        </div>
    <?php endforeach ?>
</body>