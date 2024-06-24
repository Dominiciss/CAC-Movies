<?php
//seguridad de sessiones
/* con session_start() ponemos la sesion en la BD */
session_start();
$varsession = $_SESSION['email'];
if ($varsession == null || $varsession = '') {
    echo 'Usted no tiene autorizacion';
    die();
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido Admin</title>
</head>
<body>
    <h2>Bienvenido despues de pasar el Login !!</h2>

    <a href="cerrar_sesion.php">Cerrar Sesion</a>
</body>
</html>