<?php
session_start();
include('../public/api/jsonUnicode.php');


if (
    !isset($_SESSION['pseudo'])
) {
    header('Location:indexAccueil.php');
    exit();
} else {

    ?>
    <!doctype html>

    <html lang="fr">

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../public/css/panier.css">

    </head>

    <body>
        <?php
            $adressebdd = file_get_contents('../public/api/AdresseBDD/adresseBDD.json');
            $adresseBDDJsonParsed = json_decode($adressebdd);

            $bdd = new PDO('mysql:host=' . $adresseBDDJsonParsed->{"host"} . ';port=' .
                $adresseBDDJsonParsed->{"port"} . ';dbname=' . $adresseBDDJsonParsed->{"dbname"} .
                ';', $adresseBDDJsonParsed->{"pseudo"}, $adresseBDDJsonParsed->{"mdp"});

            $requete = $bdd->prepare("SELECT article.nom as nomArticle, article.prix as prixArticle ,
            quantite from utilisateur join commande on utilisateur.id=commande.id_Utilisateur join
            commandearticle on commande.id=commandearticle.id_commande join article on
            commandearticle.id_Article=article.id where utilisateur.pseudo=:pseudo and commande.faite=0
            ");
            $requete->bindValue(':pseudo', $_SESSION["pseudo"], PDO::PARAM_STR);


            $requete->execute();

            $contenuPanier = $requete->fetchAll(PDO::FETCH_CLASS);
            $contenuPanier = objectToArray($contenuPanier);






            if (empty($contenuPanier)) {
                ?>
            <div id="vide">Votre panier est vide... qu'attendez-vous pour le remplir?</div>
        <?php
            } else {
                $total = 0;
                ?>
            <div id="cont">
                <?php
                        foreach ($contenuPanier as $article) {
                            ?>

                    <div class="article">
                        <?php

                                    $artXquant = (int) $article["prixArticle"] * (int) $article["quantite"];

                                    echo ($article["nomArticle"] . " :<prix> " . $article["prixArticle"] . "€</prix> X " . $article["quantite"] . " <div id='prix' >" . $artXquant . "€ </div>");
                                    $total += $artXquant; ?>
                    </div>
                <?php
                        }
                        ?>

                <div id="total">Total : <?php echo ($total) ?>€

                    <a href="../script/scriptFinPanier.php">
                        <div class="noDecoration" id="payer">payer</div>
                    </a>
                </div>
            </div>

        <?php
            }


            ?>




    </body>

    </html>
<?php
}
