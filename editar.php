<?php

/*MOSTRAR */
require "inicializa.php";

if (!isset($_SESSION['usuario'])) {
    header('Location:index.php');
    exit();
}



$usuario = $_SESSION['usuario'];

$html_header = Interfaz::genera_header();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<header>
    <?= "$html_header" ?>
</header>

</body>
</html>
