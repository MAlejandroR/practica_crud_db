<?php

/*MOSTRAR */
require "inicializa.php";

if (!isset($_SESSION['usuario'])) {
    header('Location:index.php');
    exit();
}

$opcion = $_POST['submit']??"";
$msj="";
$db = new DB();
$tabla = $_SESSION['tabla'];

switch ($opcion){
    case 'Guardar':
        $msj = "Se ha guardado";
        $lista="(";

        foreach ($_POST as $name=>$campo) {
            if ($name!='submit')
                $lista .="'$campo' ,";
        }
        $lista = substr($lista,0, strlen($lista)-1);
        $lista .=")";
        if ($db->insertar($tabla, $lista))
            $msj="Se ha insertado una tupla";
        else
            $msj="No se ha podido  insertar  una tupla";


    case 'Cancelar':
        $msj = $msj==""?$msj = "Se ha cancelado la acción de add un nuevo registro":$msj;
        header("Location:tabla.php?msj=$msj");
        exit;
}



$usuario = $_SESSION['usuario'];
$html_header = Interfaz::genera_header();

$campos = $db->obtener_campos($tabla);

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
<fieldset>
    <legend>Add nuevo elemento en <?= "$tabla" ?></legend>
    <form action="add.php" method="post">
        <?php
        foreach ($campos as $campo) {
            echo "$campo <input type='text' name='$campo'><br />";
        }
        ?>
        <input type="submit" value="Guardar" name="submit">
        <input type="submit" value="Cancelar" name="submit">
    </form>
</fieldset>
</body>
</html>
