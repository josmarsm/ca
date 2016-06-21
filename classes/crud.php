<?php

function insert($tabela, $attributes) {

    try {
        $pdo = conectar();
        $keys = array_keys($attributes);
        $camposTabela = implode(',', $keys);
        $values = null;
        foreach ($keys as $key) {
            $values.=',:' . $key;
        }
        $values = (trim(ltrim($values, ',')));
        $insert = $pdo->prepare("insert into $tabela ($camposTabela) values ($values)");
        $insert->execute($attributes);
        return $pdo->lastInsertId();
    } catch (PDOException $erro) {
        echo "Erro ao Inserir " . $erro->getMessage();
    }
}

function update($tabela, $campoCondicao, $valorCondicao, $attributes) {
    try {
        $pdo = conectar();
        $values = null;
        foreach ($attributes as $key => $value) {
            $values.=$key . '=:' . $key . ',';
        }
        $values = (rtrim($values, ','));
        $update = $pdo->prepare("update $tabela set $values where $campoCondicao=:valorCondicao");
        $attributes['valorCondicao'] = $valorCondicao;
        $update->execute($attributes);
        return $update;
    } catch (PDOException $erro) {
        echo "Erro ao atualizar " . $erro->getMessage();
    }
}

function readAll($tabela) {
    try {
        $pdo = conectar();
        $readAll = $pdo->query("select * from $tabela");
        $readAll->execute();
        return $readAll->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $erro) {
        echo "Erro ao listar " . $erro->getMessage();
    }
}

function readFind($sql) {
    try {
        $pdo = conectar();
        $readFind = $pdo->query("$sql");
        $readFind->execute();
        return $readFind->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $erro) {
        echo "Erro ao listar " . $erro->getMessage();
    }
}

function deletar($tabela, $campoCondicao, $valorCondicao) {
    try {
        $pdo = conectar();
        $deletar = $pdo->prepare("delete from $tabela where $campoCondicao=:valorCondicao");
        $deletar->bindValue(":id", $id);
        return $deletar->execute();
    } catch (PDOException $erro) {
        echo "Erro ao Deletar " . $erro->getMessage();
    }
}

function alterarpagina() {
    try {
        $include = filter_input(INPUT_GET, 'p', FILTER_SANITIZE_STRING);
        //$pagina = (!is_null($include)) ? $include : 'page2';
        $pagina = (!is_null($include)) ? $include : 'page2';
        //$includePagina = "pages".$pagina.".php";
        $includePagina = $pagina . ".php";
        $erro404 = "../classes/erro404.php";

        require (is_file($includePagina)) ? $includePagina : $erro404;
    } catch (PDOException $erro) {
        echo "Erro ao Alterar Página " . $erro->getMessage();
    }
}