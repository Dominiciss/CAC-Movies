<?php
include_once "./assets/php/config.php";
include_once "./assets/php/connection.php";
?>
<?php if (!session_id()) session_start() ?>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <header>
        <nav>
            <ul class="left">
                <li>
                    <a href="./index.php" class="home"><svg style="pointer-events: none" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
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
                    <?php if (!empty($_SESSION["user"])) { ?>
                        <?php if (get_role($_SESSION["user"]) == 1) { ?>
                            <li>
                                <a href="./pages/dashboard.php">Panel Admin</a>
                            </li>
                        <?php } ?>
                        <li>
                            <a id="logout">Cerrar Sesion</a>
                        </li>
                    <?php } ?>
                    <?php if (empty($_SESSION["user"])) { ?>
                        <li>
                            <a href="./pages/register.php">Registrarse</a>
                        </li>
                        <li>
                            <a href="./pages/login.php">Iniciar Sesión</a>
                        </li>
                    <?php } ?>
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
            <?php if (empty($_SESSION["user"])) { ?>
                <a href="./pages/register.php">Registrarse</a>
            <?php } ?>
        </section>
        <section class="search fade">
            <h5>¿Qué estas buscando para ver?</h5>
            <form action="#" method="POST">
                <input type="text" placeholder="Búsqueda" />
                <button type="submit">
                    <svg style="pointer-events: none" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                        <path fill="currentColor" d="m19.6 21l-6.3-6.3q-.75.6-1.725.95T9.5 16q-2.725 0-4.612-1.888T3 9.5q0-2.725 1.888-4.612T9.5 3q2.725 0 4.613 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l6.3 6.3zM9.5 14q1.875 0 3.188-1.312T14 9.5q0-1.875-1.312-3.187T9.5 5Q7.625 5 6.313 6.313T5 9.5q0 1.875 1.313 3.188T9.5 14" />
                    </svg>
                </button>
            </form>
        </section>
        <div class="divider"></div>
        <section class="featured fade" id="featured">
            <h5>Las tendencias de hoy</h5>
            <ul class="featured-container"></ul>
            <div>
                <button class="button-slides disabled" id="prev-button">
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
    <script type="module" src="./assets/js/global.js"></script>
    <script type="module" src="./assets/js/index.js"></script>
</body>

</html>