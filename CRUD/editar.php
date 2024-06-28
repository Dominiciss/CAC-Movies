<?php
error_reporting(E_ALL);
ini_set('diconexion.php', 1);

session_start();
// Añadir set-cookie: secure; HttpOnly y sessionID
$_COOKIE['PHPSESSID'] = session_id();
header('Set-Cookie: PHPSESSID=' . $_COOKIE['PHPSESSID'] . '; SameSite=None; Secure; HttpOnly');

// Incluir el archivo de configuración
require_once('../config/conexion.php');

//conexion a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "movies_cac")
    or die("Error en la conexion servidor");


if (isset($_POST['id']) && isset($_POST['image']) && isset($_POST["title"]) && isset($_POST["director"]) && isset($_POST["genre"]) && isset($_POST["date"]) && isset($_POST["rating"]) && isset($_POST["description"])) {

    $id = $_POST['id'];
    $image_id = intval($_POST['image']);
    $title = mysqli_real_escape_string($conexion, $_POST['title']);
    $director = mysqli_real_escape_string($conexion, $_POST['director']);
    $genre = mysqli_real_escape_string($conexion, $_POST['genre']);
    $date = mysqli_real_escape_string($conexion, $_POST['date']);
    $rating = mysqli_real_escape_string($conexion, $_POST['rating']);
    $description = mysqli_real_escape_string($conexion, $_POST['description']);


    // Actualizar datos de la película en la tabla `movie`
    $sqlMovie = "UPDATE movie SET title = '$title', director = '$director', genre = '$genre', date = '$date', rating = '$rating', description = '$description', image_id = '$image_id' WHERE id = '$id'";
    $resultMovie = mysqli_query($conexion, $sqlMovie);

    if ($resultMovie) {
        echo "Actualización de la película $id exitosa";
        header('Location: ../admin/dashboard.php');
        exit();
    } else {
        echo "Error en el registro de la película: " . mysqli_error($conexion);
    }
} else {
    echo "Error en la actualizacion de la pelicula: datos incompletos.";
}
