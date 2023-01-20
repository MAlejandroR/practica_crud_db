<?php


require "inicializa.php";

if (!isset($_SESSION['usuario'])) {
    header('Location:index.php');
    exit();
}

$opcion = $_POST['submit'] ?? null;
switch ($opcion) {
    case 'Volver':
        unset($_SESSION['tabla']);
        header("Location:sitio.php");
        exit;
    case 'Familias':
        $_SESSION['tabla'] = "familia";
        break;
    case 'Productos':
        $_SESSION['tabla'] = "producto";
        break;
    case 'Tiendas':
        $_SESSION['tabla'] = "tienda";
        break;
    default:

        $msj = $_GET['msj'] ?? "";

        if ($msj == "") {
            header("location:sitio.php");
            exit;
        }
}

$usuario = $_SESSION['usuario'];

$html_header = Interfaz::genera_header();

$db = new DB();
$tabla = $_SESSION['tabla'];
$listado = $db->obtener_listado($tabla);
$html_tabla = Interfaz::genera_tabla($listado, $tabla)


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
<hr/>
<?= "$msj" ?>
<fieldset>
    <form action="tabla.php" method="post">
        <input type="submit" value="Volver" name="submit">
    </form>
    <legend>Listado de la tabla <?= "$tabla" ?></legend>
    <a href="add.php">Añadir fila en <?= "$tabla" ?></a>
    <?= "$html_tabla" ?>
</fieldset>

</body>
</html>