<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establecer la conexión a la base de datos
    $con = mysqli_connect("localhost", "root", "", "movies_cac") or die("Error en la conexión al servidor");

    // Verificar la conexión
    if (!$con) {
        die("Error en la conexión a la base de datos: " . mysqli_connect_error());
    }

    // Obtener los datos del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];
    //echo "Contenido de \$_POST:<br>";
    //var_dump($_POST);

    // Consulta SQL para buscar el usuario por email
    $sql = "SELECT * FROM User WHERE email = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Verificar si se encontró el usuario
    if (mysqli_num_rows($result) == 1) {
        // Obtener los datos del usuario
        $user = mysqli_fetch_assoc($result);
        //echo "Usuario encontrado en la base de datos:<br>";
        //echo "ID: " . $user['id'] . "<br>";
        //echo "Nombre: " . $user['name'] . "<br>";
        //echo "Email: " . $user['email'] . "<br>";
        
        // Verificar la contraseña utilizando password_verify
        if (password_verify($password, $user['password'])) {
            // Contraseña correcta
            echo "Contraseña correcta. Bienvenido, " . $user['email'];
            header("Location: ../index.html");
            exit();
        } else {
            // Contraseña incorrecta
            echo "Contraseña incorrecta. Intenta de nuevo.";
            header("Location: login.html");
            exit();
        }
    } else {
        // El usuario no existe
        echo "Usuario no encontrado.";
        header("Location: register.html");
        exit();
    }

    // Cerrar la conexión y liberar los recursos
    mysqli_stmt_close($stmt);
    mysqli_close($con);
}
?>
