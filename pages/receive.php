<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir el archivo de configuración de la base de datos
//require_once '../connection.php';
$host = "localhost";
$dbname = "movies_cac";
$username = "root";
$password = "";

// Crear conexión
$con = mysqli_connect($host, $username, $password, $dbname);

// Verificar si la conexión fue exitosa
if (!$con) {
    die("Error de conexión: " . mysqli_connect_error());
}
// Definición de variables para errores y datos del formulario
$nameErr = $surnameErr = $emailErr = $password1Err = $password2Err = $dateErr = $countryErr = $termsErr = "";
$name = $surname = $email = $password1 = $password2 = $date = $country = $terms = "";

// Función para limpiar y validar datos de entrada
function test_input($data) {
    $data = trim($data); // Elimina espacios en blanco al inicio y al final
    $data = stripslashes($data); // Elimina barras invertidas
    $data = htmlspecialchars($data); // Convierte caracteres especiales en entidades HTML
    return $data;
}

// Verificar si se recibieron datos mediante POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar campo nombre
    if (empty($_POST["name"])) {
        $nameErr = "Por favor, ingresa un nombre";
    } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameErr = "Solo se permiten letras y espacios";
        }
    }

    // Validar campo apellido
    if (empty($_POST["surname"])) {
        $surnameErr = "Por favor, ingresa un apellido";
    } else {
        $surname = test_input($_POST["surname"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $surname)) {
            $surnameErr = "Solo se permiten letras y espacios";
        }
    }

    // Validar campo email
    if (empty($_POST["email"])) {
        $emailErr = "Por favor, ingresa un correo electrónico";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Formato de correo electrónico inválido";
        }
    }

    // Validar campo contraseña
    if (empty($_POST["password1"])) {
        $password1Err = "Por favor, ingresa una contraseña";
    } elseif (strlen($_POST["password1"]) < 4) {
        $password1Err = "La contraseña debe tener al menos 4 caracteres";
    } else {
        $password1 = test_input($_POST["password1"]);
    }

    // Validar campo repetir contraseña
    if (empty($_POST["password2"])) {
        $password2Err = "Por favor, ingrese nuevamente la contraseña";
    } elseif ($_POST["password2"] !== $_POST["password1"]) {
        $password2Err = "Las contraseñas no coinciden";
    } else {
        $password2 = test_input($_POST["password2"]);
    }

    // Validar campo fecha de nacimiento
    if (empty($_POST["date"])) {
        $dateErr = "Por favor, ingresa una fecha de nacimiento";
    } else {
        $date = $_POST["date"];
        // Verificar el formato de la fecha
        $dateTime = DateTime::createFromFormat('Y-m-d', $date);
        if (!$dateTime || $dateTime->format('Y-m-d') !== $date) {
            $dateErr = "Formato de fecha inválido";
        }
    }

    // Validar campo país
    if (empty($_POST["country"])) {
        $countryErr = "Por favor, selecciona un país";
    } else {
        $country = test_input($_POST["country"]);
    }

    // Validar checkbox de términos y condiciones
    if (empty($_POST["terms"])) {
        $termsErr = "Para crear una cuenta tienes que aceptar los términos";
    } else {
        $terms = $_POST["terms"];
    }

    // Verificar si no hay errores en los campos del formulario
    if (empty($nameErr) && empty($surnameErr) && empty($emailErr) && empty($password1Err) && empty($password2Err) && empty($dateErr) && empty($countryErr)) {
        // Hashear la contraseña
        $hashed_password = password_hash($password1, PASSWORD_DEFAULT);

        // Verificar si el usuario ya existe en la base de datos
        $query = "SELECT id FROM User WHERE email = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            $emailErr = "El correo electrónico ya está registrado";
            header("Location: login.html?email_error=" . urlencode($emailErr));
            exit();
        } else {
            // Preparar la consulta para insertar los datos en la tabla 'user'
            $sql = "INSERT INTO User (name, surname, email, password) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($con, $sql);

            // Vincular los parámetros
            mysqli_stmt_bind_param($stmt, "ssss", $name, $surname, $email, $hashed_password);

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

            // Cerrar la declaración preparada
            mysqli_stmt_close($stmt);
        }

        // Cerrar la conexión
        mysqli_close($con);
    } else {
        // Si se accede a este script de forma incorrecta, mostrar un mensaje de error
        echo "Acceso no permitido.";
    }

    // Guardar errores y valores en la sesión
    $_SESSION['nameErr'] = $nameErr;
    $_SESSION['surnameErr'] = $surnameErr;
    $_SESSION['emailErr'] = $emailErr;
    $_SESSION['password1Err'] = $password1Err;
    $_SESSION['password2Err'] = $password2Err;
    $_SESSION['dateErr'] = $dateErr;
    $_SESSION['countryErr'] = $countryErr;
    $_SESSION['termsErr'] = $termsErr;

    $_SESSION['name'] = $name;
    $_SESSION['surname'] = $surname;
    $_SESSION['email'] = $email;
    $_SESSION['password1'] = $password1;
    $_SESSION['password2'] = $password2;
    $_SESSION['date'] = $date;
    $_SESSION['country'] = $country;
    $_SESSION['terms'] = $terms;

    // Redirigir de vuelta a register.php si hay errores
    header("Location: register.php");
    exit();
}

?>
