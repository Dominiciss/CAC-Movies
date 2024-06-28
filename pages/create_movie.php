<?php if (!session_id()) session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar Pelicula</title>
    <link rel="shortcut icon" href="../public/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,300&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/create_movie.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php include "./fragments/navbar.php" ?>
    <main>
        <div class="card">
            <h6>Ingresar Pelicula</h6>
            <form class="create_movie" action="#" method="POST">
                <div class="input">
                    <span class="error hidden">La foto es obligatoria</span>
                    <input class="input-data empty" id="movie_file" name="file" type="file" hidden form="novalidate">
                    <label for="movie_file">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h14q.825 0 1.413.588T21 5v14q0 .825-.587 1.413T19 21zm0-2h14V5H5zm1-2h12l-3.75-5l-3 4L9 13zm-1 2V5z" />
                        </svg>
                        <img src="">
                    </label>
                </div>
                <div class="input">
                    <span class="error hidden">El titulo no puede estar vacio</span>
                    <input class="input-data" name="title" type="text" placeholder=" " form="novalidate">
                    <label>Titulo</label>
                </div>
                <div class="input">
                    <span class="error hidden">El director no puede estar vacio</span>
                    <input class="input-data" name="director" type="text" placeholder=" " form="novalidate">
                    <label>Director</label>
                </div>
                <div class="input">
                    <span class="error hidden">El genero no puede estar vacio</span>
                    <input class="input-data" name="genre" type="text" placeholder=" " form="novalidate">
                    <label>Genero</label>
                </div>
                <div class="input-group">
                    <div class="input-date half">
                        <span class="error hidden">Tiene que haber una fecha</span>
                        <input class="input-data" name="date" type="date" placeholder=" ">
                        <label>Fecha de Publicacion</label>
                    </div>
                    <div class="input half">
                        <span class="error hidden">Tiene que haber una valoracion</span>
                        <input class="input-data" name="rating" type="number" placeholder=" " form="novalidate">
                        <label>Estrellas</label>
                    </div>
                </div>
                <div class="input">
                    <textarea class="input-data" name="description" placeholder=" " form="novalidate"></textarea>
                    <label>Descripcion</label>
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
    <script type="module" src="../assets/js/create_movie.js"></script>
</body>

</html>