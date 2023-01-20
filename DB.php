<?php

//todos los métodos relacionados con el acceso de la base de datos
class DB
{

    private mysqli $conexion;

    public function __construct()
    {

        try {
            $this->conexion = new mysqli(HOST, USER, PASS, NAME_DB);
        } catch (Exception $error) {
            die("Error conectando a la base de datos " . $error->getMessage());
        }
    }

    public function insertar($tabla, $lista)
    {
        $sentencia = "Insert into $tabla values $lista";
        return $this->conexion->query($sentencia);
    }

    public function obtener_campos($tabla)
    {
        $lista_campos = [];
        $filas = $this->conexion->query("select * from $tabla");
        $campos = $filas->fetch_fields();
        foreach ($campos as $campo) {
            $lista_campos[] = $campo->name;
        }
        return $lista_campos;


    }

    public function valida_usuario(string $nombre, string $password): bool
    {
        $consulta = "select * from usuarios 
                    where nombre =?
                        and password =?
                    ";

        $stmt = $this->conexion->stmt_init();
        $stmt->prepare($consulta);
        $stmt->bind_param("ss", $nombre, $password);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0)
            return true;
        else
            return false;
    }

    /**
     * @param $tabla
     * @return array
     * Obtener un listado de un talba (todas las tuplas)
     */
    public function obtener_listado($tabla): array
    {
        $familias = [];

        $consulta = "select * from $tabla";
        $resultado = $this->conexion->query($consulta);
        $fila = $resultado->fetch_assoc();
        while ($fila) {
            $familias[] = $fila;
            $fila = $resultado->fetch_assoc();
        }

        return $familias;
    }

    public function obtener_fila(string $cod, string $tabla): array
    {

        $consulta = "select * from $tabla where cod = '$cod' ";
        $resultado = $this->conexion->query($consulta);

        return $resultado->fetch_assoc();

    }




}


?>
