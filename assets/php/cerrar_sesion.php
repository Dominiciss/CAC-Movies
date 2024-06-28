<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
// Añadir set-cookie: secure; HttpOnly y sessionID
$_COOKIE['PHPSESSID'] = session_id();
header('Set-Cookie: PHPSESSID=' . $_COOKIE['PHPSESSID'] . '; SameSite=None; Secure; HttpOnly');

// Incluir el archivo de configuración para obtener la conexión PDO
require_once('../../config/conexion.php');

session_start();
session_destroy();
header('Location: ../../index.php');

?>