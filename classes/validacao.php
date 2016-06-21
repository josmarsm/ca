<?php

include_once '../classes/config.php';
session_start();
// Verifica se houve POST e se o usuÃ¡rio ou a senha Ã©(sÃ£o) vazio(s)
if (!empty($_POST) AND (empty($_POST['usuario']) OR empty($_POST['password']))) {
    header("Location: index.php");
    exit;
}

//$usuario = $_POST['usuario'];
$newusuario = ($_POST["usuario"]);
$password = $_POST['password'];
$newpassword = sha1($password);

//echo $newusuario, $newpassword;
$loginFind = readFind("select * from usuarios WHERE (usuario='" . $newusuario . "') AND senha='" . $newpassword . "' AND ativo=1 LIMIT 1");
//$loginFind = readFind("select * from usuarios WHERE usuario="admin" AND (senha=sha1($password)) AND (ativo=1) LIMIT 1");
$row = 0;
foreach ($loginFind as $findLogin):
    $row++;
    echo "Lista candidato find:";
    echo $findLogin->nome . "<br>";if ($row > 0):
    echo "login correto<br>";
    echo $findLogin->id . "<br>";
    echo $findLogin->nivel . "<br>";
    echo $findLogin->nome . "<br>";
    $_SESSION['id'] = $findLogin->id;
    $_SESSION['nivel'] = $findLogin->nivel;
    $_SESSION['nome'] = $findLogin->nome;
    header('location:../pages/template.php');
else:
    echo "Login inválido!";
    unset($_SESSION['id']);
    unset($_SESSION['nivel']);
    unset($_SESSION['nome']);
    header('location:../pages/login.html');
endif;
endforeach;

