<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
// Añadir set-cookie: secure; HttpOnly y sessionID
$_COOKIE['PHPSESSID'] = session_id();
header('Set-Cookie: PHPSESSID=' . $_COOKIE['PHPSESSID'] . '; SameSite=None; Secure; HttpOnly');

// Incluir el archivo de configuración
require_once('../../config/conexion.php');

// Verificar que los datos del formulario están presentes
if (isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["date"]) && isset($_POST["country"])) {
    try {
        // Crear una instancia de la conexión PDO
        $conexion = new Cconexion();
        $pdo = $conexion->ConexionBD();

        if (!$pdo) {
            die("Error en la conexión al servidor");
        }

        // Escapar de manera segura los datos del formulario
        $name = htmlspecialchars($_POST["name"]);
        $surname = htmlspecialchars($_POST["surname"]);
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);
        $date = htmlspecialchars($_POST["date"]);
        $country = htmlspecialchars($_POST["country"]);

        // Encriptar la contraseña
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Preparar la consulta para evitar inyección SQL
        $stmt = $pdo->prepare("INSERT INTO userr (rol_id, name, surname, email, password, date, country) VALUES (2, ?, ?, ?, ?, ?, ?)");

        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $pdo->errorInfo()[2]);
        }

        // Ejecutar la consulta
        $result = $stmt->execute([$name, $surname, $email, $passwordHash, $date, $country]);

        if ($result) {
            //echo "Registro exitoso";
            header("Location: ../../index.php");
            exit();
        } else {
            echo "Error en el registro: " . $stmt->errorInfo()[2];
        }

    } catch (PDOException $e) {
        error_log("Error en la conexión con la base de datos: " . $e->getMessage());
    } finally {
        // Cerrar la conexión
        if ($pdo) {
            $pdo = null;
        }
    }
} else {
    echo "Error en el registro de usuarios: Faltan datos del formulario";
}
?>