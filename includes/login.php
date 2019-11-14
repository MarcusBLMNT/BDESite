<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title Connexion></title>
    <!--<link href="../public/css/login.css" rel="stylesheet" />
-->
    <link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
</head>
<header>
    <?php
    //include('../includes/headerOff.html');
    //include('../includes/menu.php');

    ?>

</header>

<body>
    <?php
    include('../includes/bddconnect.php'); ?>
    <?php
    echo lang('MESSAGE') . '' . lang('ADMIN');
    ?>

    <!--<div class="connexion">
        <form>
            <h2 style="color: white">Connexion</h2>
            <input type="text" id="pseudo name" name="Nom d'utilisateur" placeholder="Nom d'utilisateur">
            <input type="text" id="mot_de_passe" name="Mot de passe" placeholder="Mot de passe"><br><br>
            <a href=""><input type="button" value=" Connexion"></a>
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


</html>