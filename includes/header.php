<?php
session_start();
if (!isset($_SESSION['pseudo'])) {
    include '../includes/headerOff.html';
} else {
    include '../includes/headerOn.html';
}
