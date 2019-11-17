<?php
require '../includes/bddconnect.php';

$DB = new DB();
?>
<!doctype html>
<html lang="en">
<!-- page de la boutique -->

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../public/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="font-awsome/css/font-awesome.min.css">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../public/css/boutique.css">
  <script src="..public/assets/autocomplete/autocomplete-0.3.0.min.js"></script>
  <link rel="stylesheet" href="..public/assets/autocomplete/autocomplete-0.3.0.min.css">
  <link rel="stylesheet" href="...public/assets/OwlCarousel2-2.3.4/dis/assets/owl.carousel.css">
  <link rel="stylesheet" href="..public/assets/OwlCarousel2-2.3.4/dis/assets/owl.theme.default.css">
  <script src="..public/assets/OwlCarousel2-2.3.4/dis/assets/owl.carousel.js"></script>
  <link rel="stylesheet" href="..public/assets/productslider.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>boutique</title>
</head>



<body>
  <div id="body2">

    <nav class="navbar navbar-expand-lg navbar-light bg-light ">
      <a class="navbar-brand" href="#"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

          <li class="nav-item dropdown">

            <a class="nav-link dropdown-toggle" href="boutique.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Catégories
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <?php $categorie = $DB->query('SELECT * FROM categorie'); ?>
              <?php foreach ($categorie as $categories) : ?>
                <a class="dropdown-item" href="#"><?php echo $categories->nom;  ?></a>

              <?php endforeach ?>
            </div>
            <!--<div class="row">
                        <aside class="col-lg-3 col-md-4">
                            <div class="panel list">
                                <div class="panel-heading">

                                </div>
                                <div>
                                    <? php/*
                                    include("../includes/bddconnect.php");
                                    $article = $DB->query("SELECT distinct catégorie FROM `article` 
                    WHERE category_id = '1' GROUP BY brand");
                                    if (isset($_GET['categorie']) && $_GET['categorie'] != "") :
                                        $sql .= " AND categorie IN ('" . implode("','", $_GET['categorie']) . "')";
                                    endif;*/
                                    ?>

                                    <ul class="list-group">

                                        <? php/* foreach ($categorie as $categories => $new_cat) :
                                            if (isset($_GET['categorie'])) :
                                                if (in_array($new_cat['categorie'], $_GET['categorie'])) :
                                                    $brand_check = 'checked="checked"';
                                                else : $brand_check = "";
                                                endif;
                                            endif;*/
                                        ?>
                                            <li class="list-group-item">
                                                <div class="checkbox"><label>
                                                        <input type="checkbox" value="
                                    </ul>
                                </div>
                            </div>
                        </aside>
                    </div>-->
          </li>
          <ul class="lis-group">


            <div id="search_bar">
              <p><input type="checkbox" name="tri[]" value="+" />Trier par prix -/+</p>

              <datalist id="test">
                <?php $article = $DB->query('SELECT * FROM article ORDER BY prix ASC'); ?>
                <?php foreach ($article as $articles) : ?>
                  <option value="<?php echo $articles->nom;  ?>">
                    <h5><?php echo $articles->description; ?></h5>
                  <?php endforeach ?>

              </datalist>


            </div>
            <p><input type="checkbox" name="tri[]" value="-" />Trier par prix +/-</p>
            <p><input type="submit" name="submit" value="Trier" /></p>
            <?
            $ctrl = sizeof($type);
            if ($ctrl != 1) {
              echo "Attention vous n'avez pas cochez le bon nombre de cases !!";
              exit;
            } else {
              echo "Vous avez choisi comme couleurs:<br>";
              foreach ($type as $valeur) {
                echo "le " . $valeur . ".<br>";
              }
            }
            ?>


          </ul>
        </ul>


        </li>




        <form class="form-inline my-2 my-lg-0">

          <div id="search_bar">

            <input list="test" type="search" id="search" placeholder="Search..." autocomplete="off">
            <datalist id="test">
              <?php $article = $DB->query('SELECT * FROM article'); ?>
              <?php foreach ($article as $articles) : ?>
                <option value="<?php echo $articles->nom;  ?>">
                  <h5><?php echo $articles->description; ?></h5>
                <?php endforeach ?>

            </datalist>

          </div>

        </form>




      </div>
    </nav>
    <br><br><br>



    <?php $article = $DB->query('SELECT * FROM article'); ?>
    <?php foreach ($article as $articles) : ?>
      <div class="container mt-s">
        <div class="row">
          <div class="col-md-3">
            <div class="card">
              <img src="../public/images/<?php echo $articles->urlimage;  ?>" class="card-img-top">
              <div class="card-body">

                <h2><?php echo $articles->nom;  ?><br></h2>
                <h5><?php echo $articles->description; ?></h5>
                <br>


                <h2><?php echo $articles->prix; ?>€</h2>
                <br>
                <button class="btn btn-danger"><i class="fa fa-cart-plus" aria-heden="true"></i>Ajouter au panier</button>
              </div>
            </div>

          </div>



        </div>
      </div>
    <?php endforeach ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </div>
</body>

</html>