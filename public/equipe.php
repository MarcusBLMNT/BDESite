<!doctype html>
<html lang="fr">

<head>
    <title>L'équipe</title>
    <script href="../public/css/mentions.css" rel="stylesheet"></script>
</head>

<body>
    <header>
        <?php
        $id = 1;
        if ($id != NULL) {
            include('../includes/headerOn.html');
        } else {
            include('../includes/headerOff.html');
        }

        include('../includes/menu.php'); ?>
    </header>
    <div class="mentions">
        <?php
        include('../includes/equipe.html');
        ?>
    </div>


    <footer>
        <?php
        include('../includes/footer.html');
        ?>
    </footer>
</body>

</html>