<!doctype html>
<html lang="fr">

<head>
    <title>Connexion</title>
    <script href="../public/css/mentions.css" rel="stylesheet"></script>
    <link href="../public/css/login.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
</head>

<body>
    <header>
        <?php
        +include('../includes/header.php');
        include('../includes/menu.php'); ?>
    </header>
    <?php
    include('../includes/login.html');
    ?>
    <footer>
        <?php
        include('../includes/footer.html');
        ?>
    </footer>
</body>

</html>