<?php
session_start();
if ((!isset($_SESSION['id']) == false) and (!isset($_SESSION['nivel']) == false)) :
    //echo "esta logado";
    $logado = $_SESSION['id'];
else:
    unset($_SESSION['id']);
    unset($_SESSION['nivel']);
    unset($_SESSION['nome']);
    //echo "<script>window.open(...)</script>";
//echo "não esta logado";
    header('location:../pages/login.html');
    
endif;