<?php

$conexion = mysqli_connect("localhost", "root", "", "movies_cac");
if (!$conexion) {
    die("Error en la conexión al servidor: " . mysqli_connect_error());
}

$id = $_GET['id'];

$sql = "DELETE FROM movie WHERE id = $id";

$query = mysqli_query($conexion, $sql);


if ($query) {
    // header('Location: ../../admin/dashboard.php');
    // exit();
    echo "Datos eliminados correctamente";
    var_dump($query);
} else {
    echo "Error al eliminar datos";
}
