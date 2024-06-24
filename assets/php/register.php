<?php

if (isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["date"]) && isset($_POST["country"])) {
    //conexion a la base de datos
    $con = mysqli_connect("localhost", "root", "", "movies_cac")
        or die("Error en la conexion servidor");

    //query para insertar los datos en la tabla 'user'
    $sql = "INSERT INTO user (name, surname, email, password, date, country) 
    VALUES ('$_POST[name]', '$_POST[surname]', '$_POST[email]', '$_POST[password]', '$_POST[date]', '$_POST[country]')";

    //ejecutar la query
    $result = mysqli_query($con, $sql);

    if($result) {
        echo "Registro exitoso";
        header("Location: ../../index.php");
        exit();
    } else {
        echo "Error en el registro";
    }

} else {
    echo "Error en el registro";
}

?>
