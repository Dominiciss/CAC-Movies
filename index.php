<!DOCTYPE html>
<html lang="es" data-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CAC-MOVIES</title>
    <link rel="shortcut icon" href="./public/favicon.ico" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,300&amp;display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/global.css" />
    <link rel="stylesheet" href="./assets/css/index.css" />
</head>

<body>
    <header>
        <nav>
            <ul class="left">
                <li>
                    <a href="#" class="home"><svg style="pointer-events: none" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
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
                        <a href="#featured">Tendencias</a>
                    </li>
                    <li>
                        <a href="./pages/register.php">Registrarse</a>
                    </li>
                    <li>
                        <?php
                        session_start();
                        // Verificar si hay una sesión iniciada
                        if (isset($_SESSION['email'])) {
                            // Conexión a la base de datos
                            $con = mysqli_connect("localhost", "root", "", "movies_cac");

                            if (!$con) {
                                die("Error en la conexión al servidor: " . mysqli_connect_error());
                            }

                            // Obtener el rol del usuario
                            $email = $_SESSION['email'];
                            $sql = "SELECT rol_id FROM user WHERE email = ?";
                            $stmt = mysqli_prepare($con, $sql);
                            if ($stmt) {
                                // Vincular el parámetro y ejecutar la consulta
                                mysqli_stmt_bind_param($stmt, 's', $email);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);

                                if ($result) {
                                    $row = mysqli_fetch_array($result);

                                    if ($row['rol_id'] == 1) { // admin
                                        echo '<a href="./admin/dashboard.php">Volver al dashboard</a>';
                                    } else if ($row['rol_id'] == 2) { // user
                                        echo '<a href="./assets/php/cerrar_sesion.php">Cerrar sesión</a>';
                                    } else {
                                        echo '<a href="./pages/login.php">Iniciar sesión</a>';
                                    }
                                } else {
                                    echo '<a href="./pages/login.php">Iniciar sesión</a>';
                                }

                                // Cerrar la conexión
                                mysqli_stmt_close($stmt);
                            } else {
                                echo '<a href="./pages/login.php">Iniciar sesión</a>';
                            }

                            mysqli_close($con);
                        } else {
                            echo '<a href="./pages/login.php">Iniciar sesión</a>';
                        }
                        ?>
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
        <section class="banner">
            <h1>Películas y series ilimitadas en un solo lugar</h1>
            <h2>Disfruta donde quieras. Cancela en cualquier momento.</h2>
            <a href="./pages/register.php">Registrarse</a>
        </section>
        <section class="search fade">
            <h5>¿Qué estas buscando para ver?</h5>
            <!-- Input con Ajax y Js sobre la api de themoviedb.org -->
            <input type="text" id="search-input" placeholder="Buscar por título...">
        </section>
        <div class="divider"></div>
        <section class="featured fade" id="featured">
            <h5>Las tendencias de hoy</h5>
            <ul class="featured-container"></ul>
            <div>
                <button class="button-slides" id="prev-button">
                    <svg style="pointer-events: none" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m15 5l-6 7l6 7" />
                    </svg>
                </button>
                <button class="button-slides" id="next-button">
                    <svg style="pointer-events: none" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m9 5l6 7l-6 7" />
                    </svg>
                </button>
            </div>
        </section>
        <div class="divider"></div>
        <section class="best fade">
            <h5>Las más aclamadas</h5>
            <div class="carousel">
                <ul class="best-container"></ul>
            </div>
        </section>
    </main>
    <footer>
        <ul>
            <li><a href="#">Términos y condiciones</a></li>
            <li><a href="#">Preguntas frecuentes</a></li>
            <li><a href="#">Ayuda</a></li>
            <li><a href="#">Administrador Peliculas</a></li>
        </ul>
        <a href="#" class="go-back"><svg style="pointer-events: none" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m17 14l-5-5m0 0l-5 5" />
            </svg></a>
    </footer>
</body>
<script type="module" src="./assets/js/global.js"></script>
<script type="module" src="./assets/js/index.js"></script>
</html>
