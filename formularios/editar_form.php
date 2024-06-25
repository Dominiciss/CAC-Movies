<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar Pelicula</title>
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
                        <a href="../admin/dashboard.php">Admin Dashboard</a>
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
        <div class="card">
            <h1>Editar Pelicula</h1>
            <form class="container p-5 create_movie" action="../CRUD/editar.php" method="POST" enctype="multipart/form-data">
                <?php
                $conexion = mysqli_connect("localhost", "root", "", "movies_cac");
                if (!$conexion) {
                    die("Error en la conexión al servidor: " . mysqli_connect_error());
                }

                //si existe el id en la url
                if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
                    $id = intval($_REQUEST['id']);

                    //traemos todos los datos de la pelicula y la tabla image
                    $sql = $conexion->query(
                        "SELECT m.*, i.id AS image_id, i.name AS image_name, i.content AS image_content
                        FROM movie m
                        LEFT JOIN image i ON m.image_id = i.id
                        WHERE m.id = $id;"
                    );

                    //Verificar que se econtró la pelicula
                    if ($sql->num_rows > 0) {
                        $resultado = $sql->fetch_assoc();
                    } else {
                        echo "No se encontró la pelicula con id $id";
                        exit;
                    }
                } else {
                    echo "No se ha seleccionado ninguna pelicula";
                    exit;
                }
                ?>

                <!--  Input Id de la pelicula en modo oculto 'hidden' porque se envia con el formulario -->
                <input name="id" type="hidden" value="<?php echo $resultado['id']; ?>">


                <!-- TRAER DATOS IMAGEN ASOCIADA (TABLA IMAGE) -->
                <!-- Muestra la imagen actual -->
                <div class="container d-flex flex-column justify-content-center">
                    <img src="data:image/jpg;base64,<?php echo base64_encode($resultado['image_content']); ?>" width="250" height="250" style="padding: 0px 5rem">
                </div>

                <!-- Selecciona las imagenes restantes de la base de datos -->
                <div class="input">
                    <select class="form-select" name="image" id="image">
                        <?php
                        $sql1 = "SELECT * FROM image WHERE id = " . $resultado['image_id'] . " UNION SELECT * FROM image WHERE id != " . $resultado['image_id'] . " ORDER BY id DESC;";
                        $result1 = $conexion->query($sql1);

                        echo "<option value='" . $resultado['image_id'] . "' selected>" . $resultado['image_name'] . "</option>";

                        while ($row = $result1->fetch_assoc()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['name']  . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- TRAER DATOS PELICULA (TABLA MOVIE) -->
                <div class="input">
                    <span class="error hidden">El titulo no puede estar vacio</span>
                    <input class="input-data" name="title" type="text" value="<?php echo $resultado['title']; ?>">
                </div>
                <div class="input">
                    <span class="error hidden">El director no puede estar vacio</span>
                    <input class="input-data" name="director" type="text" value="<?php echo $resultado['director']; ?>">
                </div>
                <div class="input">
                    <span class="error hidden">El genero no puede estar vacio</span>
                    <input class="input-data" name="genre" type="text" value="<?php echo $resultado['genre']; ?>">
                </div>
                <div class="input-group">
                    <div class="input-date half">
                        <span class="error hidden">Tiene que haber una fecha</span>
                        <input class="input-data" name="date" type="date" value="<?php echo $resultado['date']; ?>">
                    </div>
                    <div class="input half">
                        <span class="error hidden">Tiene que haber una valoracion</span>
                        <input class="input-data" name="rating" type="number" value="<?php echo $resultado['rating']; ?>">
                    </div>
                </div>
                <div class="input">
                    <textarea class="input-data" name="description" placeholder="<?php echo $resultado['description']; ?>"></textarea>
                </div>
                <div class="button">
                    <button type="submit">Ingresar Pelicula</button>
                </div>
            </form>
        </div>
    </main>
    <footer>
    </footer>

    <script type="module" src="../assets/js/global.js"></script>
    <script type="module" src="../assets/js/edit_movie.js"></script>

</body>

</html>