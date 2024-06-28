<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
// Añadir set-cookie: secure; HttpOnly y sessionID
$_COOKIE['PHPSESSID'] = session_id();
header('Set-Cookie: PHPSESSID=' . $_COOKIE['PHPSESSID'] . '; SameSite=None; Secure; HttpOnly');

// Incluir el archivo de configuración para obtener la conexión PDO
require_once('../../config/conexion.php');

if (isset($_POST["email"]) && isset($_POST["password"])) {
    try {
        // Conexión a la base de datos usando PDO desde el archivo de configuración
        $conexion = new PDO("mysql:host=localhost;dbname=id22319561_cac_movies", "id22319561_root", "CaC2024!");
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Escapar de manera segura los datos del formulario (aunque se usará consulta preparada)
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Preparar la consulta para verificar las credenciales
        $stmt = $conexion->prepare("SELECT * FROM userr WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si se encontró un usuario y verificar la contraseña
        if ($user && password_verify($password, $user['password'])) {
            // Iniciar sesión y redirigir al usuario
            $_SESSION['user_id'] = $user['id']; // Asumiendo que tienes un campo 'id' en tu tabla 'userr'
            //echo "Inicio de sesión exitoso";
            header("Location: ../../index.php");
            exit();
        } else {
            echo "Credenciales incorrectas";
        }
    } catch (PDOException $e) {
        echo "Error en la conexión o consulta: " . $e->getMessage();
    } finally {
        // Cerrar la conexión
        $conexion = null;
    }
} else {
    echo "Error: Faltan datos del formulario";
}
?>