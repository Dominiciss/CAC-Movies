<?php

$conexion = mysqli_connect("localhost", "root", "", "movies_cac");
if (!$conexion) {
    die("Error en la conexión al servidor: " . mysqli_connect_error());
}

$id = $_GET['id'];
$sql = "DELETE FROM movie WHERE id = $id";
$query = mysqli_query($conexion, $sql);

if ($query) {
    echo "Datos eliminados correctamente";
    header('Location: ../admin/dashboard.php');
    exit();
} else {
    echo "Error al eliminar datos";
}

?>
