<?php
require '../includes/bddconnect.php';
$DB = new DB();
?>
<!doctype html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" href="../public/css/styleHeaderOn.css">
	<link rel="stylesheet" href="../public/assets/vendors/fontawesome/css/all.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
	<script src=https://kit.fontawesome.com/b99e675b6e.js> </script> <script src="script.js"></script>
</head>

<header>
	<img src="../public/images/logo.png" alt="Logo BDE" />
	<div class="logo">
		<a href="../public/indexAccueil.php">
			<h1>BDE CESI</h1>
		</a>
		<a href="../public/indexAccueil.php">
			<h2>Bordeaux</h2>
		</a>
	</div>
	<nav class="menu">
		<ul>
			<li><a href="#"><i class="fas fa-user-circle"></i></a></li>
			<li><a href="#"><i class="fas fa-shopping-basket"></i></a></li>
			<li><a href="../script/scriptFinSession.php"><i class="fas fa-power-off"></i></a></li>

		</ul>
	</nav>
</header>


<body>

</body>

</html>