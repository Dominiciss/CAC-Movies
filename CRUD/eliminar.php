<?php
error_reporting(E_ALL);
ini_set('diconexion.php', 1);

session_start();
// Añadir set-cookie: secure; HttpOnly y sessionID
$_COOKIE['PHPSESSID'] = session_id();
header('Set-Cookie: PHPSESSID=' . $_COOKIE['PHPSESSID'] . '; SameSite=None; Secure; HttpOnly');

// Incluir el archivo de configuración
require_once('../config/conexion.php');
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
