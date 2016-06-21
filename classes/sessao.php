<?php

//session_start();
//print_r($_SESSION['id']);
    //if ($_SESSION['id']== true):

//$usuario = $_SESSION['id'];
//if(empty($usuario)) session_start();
    $usuario = $_SESSION['id'];
   // e$ndif;
echo $usuario;

$usuarioFind = readFind("select * from usuarios where id='$usuario'");
foreach ($usuarioFind as $usuario):
    $usuario->nome;
endforeach;
$newID = $usuario->id;
$newNivel = $usuario->nivel;
$newUsuario = $usuario->nome;