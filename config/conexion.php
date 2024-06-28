<?php

class Cconexion
{
    public function ConexionBD()
    {
        $host = "localhost";
        $dbname = "id22319561_cac_movies";
        $username = "id22319561_root";
        $password = "CaC2024!";
        try {
            $conexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password, [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
            ]);
            return $conexion;
        } catch (PDOException $e) {
            error_log("No se logro conectar correctamente con la base de datos:$dbname, error: $e");
        }
        return null;
    }
}

?>