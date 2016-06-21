<?php

function conectar() {
    $DB_host = "localhost";
    $DB_user = "root";
    $DB_pass = "Ramsoj@123";
    $DB_name = "ca";
    $pdo = new PDO("mysql:host={$DB_host};dbname={$DB_name}", $DB_user, $DB_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}
