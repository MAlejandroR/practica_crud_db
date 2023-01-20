<?php

class Interfaz
{

    static function genera_header(){
        $usuario = $_SESSION['usuario'];
        $html=<<<FIN
 <h2>Conectado como <?="$usuario"?>
        <form action="index.php" method="get">
            <input type="submit" value="logout" name="submit">
        </form>

    </h2>
FIN;
        return $html;

    }
static public function genera_tabla(array $datos, string $titulo):string{
    $tabla = "<table>";
    $tabla.="<caption>$titulo</caption>";
    $fila = $datos[0];
    //Creo la cabecera de la tabla con los nombres de los campos
    $tabla.="<tr>";
    foreach ($fila as $campo =>$valor)
      $tabla.="<th>$campo</th>";
    $tabla.="</tr>";

    //Muestro cada fila los campos
    foreach ($datos as $fila=>$campos) {
        $tabla.="<tr>";//Una fila de datos
        foreach ($campos as $campo)//Los valores
            $tabla.="<td>$campo</td>";
        $tabla.="<td><form action = 'editar.php' method='POST'>
                 <input type='submit' value='Editar'>
                 <input type='submit' value='Borrar'>
                 <input type='hidden' name='cod'  value='{$campos['cod']}' >
                 </form>
                 </td>";
        $tabla.="</tr>";
    }

    $tabla .= "</table>";

    return $tabla;
}
}