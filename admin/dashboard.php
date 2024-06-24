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

<!-- <a href="cerrar_sesion.php">Cerrar Sesion</a> -->

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <br>
    <div class="container">
        <h1 class="text-center bg-dark text-light">LISTADO DE PELICULAS</h1>
    </div>
    <br>
    <div class="container-fluid">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Director</th>
                    <th scope="col">Genero</th>
                    <th scope="col">F. Creacion</th>
                    <th scope="col">Rating</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Imagen</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conexion = mysqli_connect("localhost", "root", "", "movies_cac");
                if (!$conexion) {
                   die("Error en la conexión al servidor: " . mysqli_connect_error());
                }
                //tabla movie (id, image_id, title, dorector ,genre, date, rating, description) LEFT JOIN con tabla image (id, name, content, mime)
                $sql = $conexion->query(
                    "SELECT m.*, i.id AS image_id, i.name AS image_name, i.content AS image_content
                    FROM movie m
                    LEFT JOIN image i ON m.image_id = i.id;");


                while ($resultado = $sql->fetch_assoc()) {
                ?>

                    <tr>
                        <th scope="row"><?php echo $resultado['id'] ?></th>
                        <th scope="row"><?php echo $resultado['title'] ?></th>
                        <th scope="row"><?php echo $resultado['director'] ?></th>
                        <th scope="row"><?php echo $resultado['genre'] ?></th>
                        <th scope="row"><?php echo $resultado['date'] ?></th>
                        <th scope="row"><?php echo $resultado['rating'] ?></th>
                        <th scope="row"><?php echo $resultado['description'] ?></th>
                        <th scope="row"><img src="data:image/jpg;base64,<?php echo base64_encode($resultado['image_content']); ?>" width="50" height="50"></th>
                        <th scope="row">
                            <a href="./formularios/editar_form.php?id=<?php echo $resultado['id'] ?>" class="btn btn-warning">Editar</a>
                            <a href="./CRUD/eliminar.php?id=<?php echo $resultado['id'] ?>" class="btn btn-danger">Eliminar</a>
                        </th>
                    </tr>
                <?php
                }
                ?>


            </tbody>
        </table>
        <a href="./formularios/agregar_form.php" class="btn btn-primary">Agregar Producto</a>
    </div>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
</body>

</html>