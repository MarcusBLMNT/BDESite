<?php


session_start();

//header global, gérant la visibilité pour les personnes connectes et non connecté
if (!isset($_SESSION['pseudo'])) {
    include '../includes/headerOff.html';
} else {
    include '../includes/headerOn.html';
}
