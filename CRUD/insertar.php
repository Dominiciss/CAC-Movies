<?php

if (isset($_FILES["file"]) && isset($_POST["title"]) && isset($_POST["director"]) && isset($_POST["genre"]) && isset($_POST["date"]) && isset($_POST["rating"]) && isset($_POST["description"])) {
    //conexion a la base de datos
    $con = mysqli_connect("localhost", "root", "", "movies_cac")
        or die("Error en la conexion servidor");

    // Manejando el archivo de imagen
    $image = $_FILES["file"]["name"];
    $imageContent = addslashes(file_get_contents($_FILES["file"]["tmp_name"]));
    $imageMime = $_FILES["file"]["type"];

    // Insertar imagen en la tabla `image`
    $sqlImage = "INSERT INTO image (name, content, mime) VALUES ('$image', '$imageContent', '$imageMime')";
    $resultImage = mysqli_query($con, $sqlImage);

    if ($resultImage) {
        // Obtener el ID de la imagen insertada
        $imageId = mysqli_insert_id($con);

        // Insertar datos de la película en la tabla `movie`
        $sqlMovie = "INSERT INTO movie (image_id, title, director, genre, date, rating, description) 
                       VALUES ('$imageId', '$_POST[title]', '$_POST[director]', '$_POST[genre]', '$_POST[date]', '$_POST[rating]', '$_POST[description]')";

        $resultMovie = mysqli_query($con, $sqlMovie);

        if ($resultMovie) {
            echo "Registro de pelicula id $id exitoso";
            header('Location: ../admin/dashboard.php');
            exit();
        } else {
            echo "Error en el registro de la película";
        }
    } else {
        echo "Error en el registro de la imagen";
    }
} else {
    echo "Error en el registro";
}
