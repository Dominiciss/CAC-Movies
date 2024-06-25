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
                        <a href="../admin/dashboard.php">Volver al Dashboard</a>
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
            <h6>Ingresar Pelicula</h6>
            <form form class="create_movie" action="../CRUD/insertar.php" method="POST" enctype="multipart/form-data">
                <div class="input">
                    <span class="error hidden">La foto es obligatoria</span>
                    <input class="input-data empty" id="movie_file" name="file" type="file" hidden>
                    <label for="movie_file">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h14q.825 0 1.413.588T21 5v14q0 .825-.587 1.413T19 21zm0-2h14V5H5zm1-2h12l-3.75-5l-3 4L9 13zm-1 2V5z" />
                        </svg>
                        <img src="">
                    </label>
                </div>
                <div class="input">
                    <span class="error hidden">El titulo no puede estar vacio</span>
                    <input class="input-data" name="title" type="text" placeholder=" ">
                    <label>Titulo</label>
                </div>
                <div class="input">
                    <span class="error hidden">El director no puede estar vacio</span>
                    <input class="input-data" name="director" type="text" placeholder=" ">
                    <label>Director</label>
                </div>
                <div class="input">
                    <span class="error hidden">El genero no puede estar vacio</span>
                    <input class="input-data" name="genre" type="text" placeholder=" ">
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
                        <input class="input-data" name="rating" type="number" placeholder=" ">
                        <label>Estrellas</label>
                    </div>
                </div>
                <div class="input">
                    <textarea class="input-data" name="description" placeholder=" "></textarea>
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