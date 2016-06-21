<?php
	session_start(); // Inicia a sess�o
	session_destroy(); // Destr�i a sess�o limpando todos os valores salvos
	header("Location: ../pages/login.html"); exit; // Redireciona o visitante

    //require("config.php"); 
    //unset($_SESSION['user']);
    //echo "saiu";
    //header("Location: index.php"); 
    //die("Redirecting to: index.php");
?>