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
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    $date = $_POST['date'];
    $country = $_POST['country'];

    // Verificar que las contraseñas sean iguales
    if ($password1 !== $password2) {
        die("Las contraseñas no coinciden. Intenta de nuevo.");
    }

    // Hashear la contraseña
    $hashed_password = password_hash($password1, PASSWORD_DEFAULT);

    // Consulta SQL preparada para insertar los datos en la tabla 'user'
    $sql = "INSERT INTO user (name, surname, email, password, date, country) VALUES (?, ?, ?, ?, ?, ?)";

    // Preparar la consulta
    $stmt = mysqli_prepare($con, $sql);

    // Vincular los parámetros
    mysqli_stmt_bind_param($stmt, "ssssss", $name, $surname, $email, $hashed_password, $date, $country);

    // Ejecutar la consulta
    if (mysqli_stmt_execute($stmt)) {
        // La inserción fue exitosa
        echo "Usuario registrado correctamente";
        // Redireccionar a una página de confirmación
        header("Location: login.html");
        exit();
    } else {
        // Ocurrió un error durante la inserción
        echo "Error al registrar el usuario: " . mysqli_error($con);
    }

    // Cerrar la conexión
    mysqli_stmt_close($stmt);
    mysqli_close($con);
} else {
    // Si se accede a este script de forma incorrecta, mostrar un mensaje de error
    echo "Acceso no permitido.";
}
?>
