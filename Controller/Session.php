<?php
session_start();
if (!isset($_SESSION['id'], $_SESSION['nome']/*, $_SESSION['email']*/)) {
    header('LOCATION: ../index.php');
}