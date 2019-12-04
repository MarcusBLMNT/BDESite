<?php
require 'bddconnect.php';
require 'getStatut.php';

if (getStatut() == 0) {
    header('Location:indexLogin.php');
    exit();
}
echo "coucou";
