<?php

$bdd = new PDO(
    'mysql:host=localhost;dbname=projetweb;charset=utf8',
    'root',
    ''
);

$pseudo = $_SESSION['pseudo'];
$id_photo = $_POST['id_photo'];
