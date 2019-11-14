<?php
session_start();
include('../public/api/jsonUnicode.php');


if (
    !isset($_SESSION['pseudo'])  ||
    empty($_SESSION['pseudo'])
) {
    header('Location:indexAccueil.php');
    exit();
} else {

    ?>
    <!doctype html>

    <html lang="fr">

    <head>
        <meta charset="utf-8">
        <title>Titre de la page</title>
        <link rel="stylesheet" href="style.css">

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
            commandearticle.id_Article=article.id where utilisateur.pseudo=\"" . $_SESSION["pseudo"] . "\" and commande.faite=0
            ");

            $requete->execute();

            $contenuPanier = $requete->fetchAll(PDO::FETCH_CLASS);
            $contenuPanier = objectToArray($contenuPanier);






            if (empty($contenuPanier)) {
                echo "votre panier est vide";
            } else {
                $total = 0;
                foreach ($contenuPanier as $article) {

                    $artXquant = (int) $article["prixArticle"] * (int) $article["quantite"];
                    echo ($article["nomArticle"] . " : " . $article["prixArticle"] . "€ * " . $article["quantite"] . " = " . $artXquant . "€ </br>");
                    $total += $artXquant;
                }
                echo "</br><h4>total = " . $total . "€</h4>";
                ?>
            <button>payer</button>
        <?php
            }


            ?>




    </body>

    </html>
<?php
}
?>