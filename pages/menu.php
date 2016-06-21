<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="container-fluid">
    <div class="navbar-header">
        <a class="navbar-brand" href="?p=page1">CA 0.2</a>
    </div>
    <ul class="nav navbar-nav">
        <li class="active">
            <a href="?p=page2">Home</a></li>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Cadastros <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="#">Page 1-1</a></li>
                <li><a href="#">Page 1-2</a></li>
                <li><a href="#">Page 1-3</a></li>
            </ul>
        </li>
        <li><a href="#">Relatórios</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i><?php
                $usuario = $_SESSION['id'];
                $usuarioFind = readFind("select * from usuarios where id='$usuario'");
                foreach ($usuarioFind as $usuario):
                    $usuario->nome;
                endforeach;
                $newID = $usuario->id;
                $newNivel = $usuario->nivel;
                $newUsuario = $usuario->nome;
                echo "Bem Vindo $newUsuario!";
                ?> <i class="fa fa-caret-down"></i>
            </a>
        </li>
        <li>
            <a href="?p=perfil"><span class="glyphicon glyphicon-log-out"></span> Perfil</a>
        </li>
        <li>
            <a href="../classes/logout.php"><span class="glyphicon glyphicon-log-out"></span> Sair</a>
        </li> 
    </ul>
</div>