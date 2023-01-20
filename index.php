<?php

$opcion = $_GET['submit'] ?? "";
if ($opcion == "logout") {
    session_start();
    session_destroy();
}
if (isset($_POST['submit'])) {


    //Cargo los ficheros que vaya a utilizar
    require "inicializa.php";


    //Me conecto a la base de datos
    $bd = new DB();

    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    if ($bd->valida_usuario($usuario, $password)) {
        $_SESSION['usuario'] = $usuario;
        header("Location:sitio.php");
        exit();
    } else {
        $msj = "Datos de contexión incorrectos";
    }

}

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
<fieldset>
    <legend>Datos de conexión</legend>
    <h2><?= $msj ?? null ?></h2>
    <form action="index.php" method="POST">
        Usuario <input type="text" name="usuario" id="">
        Password <input type="text" name="password" id="">
        <hr>
        <input type="submit" value="Acceder" name="submit">
    </form>
</fieldset>

</body>
</html>


