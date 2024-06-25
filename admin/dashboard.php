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
    <title>Ingresar Pelicula</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="shortcut icon" href="../public/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,300&amp;display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/create_movie.css">
</head>

<body>
    <header>
        <nav>
            <ul class="left">
                <li>
                    <a href="../index.php" class="home"><svg style="pointer-events: none" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <g fill="none">
                                <path d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022m-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                                <path fill="currentColor" d="M20 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2zm-4 2H8v14h8zm4 12h-2v2h2zM6 17H4v2h2zm14-4h-2v2h2zM6 13H4v2h2zm14-4h-2v2h2zM6 9H4v2h2zm14-4h-2v2h2zM6 5H4v2h2z" />
                            </g>
                        </svg>
                        <span>CAC-Movies</span></a>
                </li>
            </ul>
            <ul class="mid"></ul>
            <div class="right">
                <ul id="dropdown-menu">
                    <li>
                        <a href="../index.php">Ver Tendencias</a>
                    </li>
                    <li>
                        <a href="../assets/php/cerrar_sesion.php">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
            <button type="button" class="dropdown">
                <svg style="pointer-events: none" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" fill-rule="evenodd" d="M20.75 7a.75.75 0 0 1-.75.75H4a.75.75 0 0 1 0-1.5h16a.75.75 0 0 1 .75.75m0 5a.75.75 0 0 1-.75.75H4a.75.75 0 0 1 0-1.5h16a.75.75 0 0 1 .75.75m0 5a.75.75 0 0 1-.75.75H4a.75.75 0 0 1 0-1.5h16a.75.75 0 0 1 .75.75" clip-rule="evenodd" />
                </svg>
            </button>
        </nav>
    </header>
    <main>
        <div class="container-fluid d-flex text-center flex-column justify-content-center">
            <span class="bg-dark">
                <h1 class="text-light">LISTADO DE PELICULAS</h1>
            </span>
            <span class="bg-dark d-flex justify-content-end align-items-center pe-4 py-2">
                <a href="../formularios/agregar_form.php" class="btn btn-success">Agregar Pelicula</a>
            </span>
            <div class="container-fluid bg-light py-5 px-2">
                <table class="table table-light table-hoverable">
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
                    LEFT JOIN image i ON m.image_id = i.id;"
                        );


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
                                    <a href="../formularios/editar_form.php?id=<?php echo htmlspecialchars($resultado['id']); ?>" class="btn btn-warning">Editar</a>
                                    <a href="../CRUD/eliminar.php?id=<?php echo htmlspecialchars($resultado['id']); ?>" class="btn btn-danger">Eliminar</a>
                                </th>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>