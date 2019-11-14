<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Connexion</title>

    <link href="../public/css/login.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
</head>
<header>

    <?php
    include('headerOff.html');
    include('menu.php');

    ?>

</header>

<body>

    <div class="connexion">
        <form method="post" action="../script/scriptConnexion.php" autocomplete="off">
            <h2 style="color: white">Connexion</h2>
            <input type="text" id="pseudo" name="pseudo" placeholder="Nom d'utilisateur">
            <input type="password" id="motDePasse" name="motDePasse" placeholder="Mot de passe"><br><br>
            <input type="submit" value=" Connexion">
            <br><br>
            <div id="container">
                <a href="" style="margin-right:0px; font-size: 13px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Mot

                    de passe oublié?</a>

            </div>
            <br> <br><br> <br><br> <br>
            Je n'ai pas de compte:<a href="../includes/inscription.php">S'inscrire</a>
        </form>
    </div>

</body>
<footer>
    <<<<<<< HEAD <?php
                    include('footer.html');
                    ?> </footer>=======>>>>>>> sofia


</html>