<?php
error_reporting(E_ALL);
ini_set("display_errors", true);

session_start();

require "credenciales.php";
function carga($clase)
{
    require "$clase.php";
}


spl_autoload_register("carga");


//Si ya estoy conectado voy directamente a sitio
?>