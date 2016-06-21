<?php
include_once '../classes/config.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Secretaria Integrada - Controle de Atendimentos</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body>

        <nav class="navbar navbar-default">
            <?php include_once 'menu.php'; ?>
        </nav>

        <div class="container">
            <?php alterarpagina(); ?>
        </div>

    </body>
</html>