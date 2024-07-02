<?php
include_once "./../assets/php/config.php";
include_once "./../assets/php/connection.php";

$total_users_count = get_total_users_count();
$total_movies_count = get_total_movies_count();
$today_users_count = get_today_users_count();
$today_movies_count = get_today_movies_count();
$month_users_count = get_month_users_count();
$month_movies_count = get_month_movies_count();

$users = get_users();
$movies = get_movies();
?>
<?php if (!session_id()) session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="shortcut icon" href="../public/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,300&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php include_once "./fragments/navbar.php" ?>
    <main>
        <?php if (empty($_SESSION["user"]) || get_role($_SESSION["user"]) != 1) { ?>
            <div class="error-404">
                <div>
                    <div></div>
                    <a href="./../">Volver a inicio</a>
                </div>
            </div>
    </main>
<?php } else { ?>
    <main>
        <h3>Estadisticas</h3>
        <section class="main_section">
            <section class="stats_section">
                <div class="users_data">
                    <div class="pie_selector">
                        <div class="active">Hoy</div>
                        <div>Mes</div>
                    </div>
                    <h5>Usuarios registrados</h5>
                    <div class="wrapper">
                        <div class="pie_container">
                            <div class="item">
                                <div class="identifiers">
                                    <div>
                                        <div style="--color: red;"></div>
                                        <span>Totales: <?php echo $total_users_count ?> (<?php echo round(($total_users_count - $today_users_count) / $total_users_count * 100) ?>%)</span>
                                    </div>
                                    <div>
                                        <div style="--color: blue;"></div>
                                        <span>Hoy: <?php echo $today_users_count ?> (<?php echo round($today_users_count / $total_users_count * 100) ?>%)</span>
                                    </div>
                                </div>
                                <div class="pie">
                                    <div class="part one" style="--color: blue; --percentage: <?php echo $today_users_count / $total_users_count * 100 ?>;"></div>
                                    <div class="part two" style="--color: red; --percentage: <?php echo ($total_users_count - $today_users_count) / $total_users_count * 100 ?>;"></div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="identifiers">
                                    <div>
                                        <div style="--color: red;"></div>
                                        <span>Totales: <?php echo $total_users_count ?> (<?php echo round(($total_users_count - $month_users_count) / $total_users_count * 100) ?>%)</span>
                                    </div>
                                    <div>
                                        <div style="--color: blue;"></div>
                                        <span>Mes: <?php echo $month_users_count ?> (<?php echo round($month_users_count / $total_users_count * 100) ?>%)</span>
                                    </div>
                                </div>
                                <div class="pie">
                                    <div class="part one" style="--color: blue; --percentage: <?php echo $month_users_count / $total_users_count * 100 ?>;"></div>
                                    <div class="part two" style="--color: red; --percentage: <?php echo ($total_users_count - $month_users_count) / $total_users_count * 100 ?>;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="movies_data">
                    <div class="pie_selector">
                        <div class="active">Hoy</div>
                        <div>Mes</div>
                    </div>
                    <h5>Peliculas registradas</h5>
                    <div class="wrapper">
                        <div class="pie_container">
                            <div class="item">
                                <div class="identifiers">
                                    <div>
                                        <div style="--color: red;"></div>
                                        <span>Totales: <?php echo $total_movies_count ?> (<?php echo round(($total_movies_count - $today_movies_count) / $total_movies_count * 100) ?>%)</span>
                                    </div>
                                    <div>
                                        <div style="--color: blue;"></div>
                                        <span>Hoy: <?php echo $today_movies_count ?> (<?php echo round($today_movies_count / $total_movies_count * 100) ?>%)</span>
                                    </div>
                                </div>
                                <div class="pie">
                                    <div class="part one" style="--color: blue; --percentage: <?php echo $today_movies_count / $total_movies_count * 100 ?>;"></div>
                                    <div class="part two" style="--color: red; --percentage: <?php echo ($total_movies_count - $today_movies_count) / $total_movies_count * 100 ?>;"></div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="identifiers">
                                    <div>
                                        <div style="--color: red;"></div>
                                        <span>Totales: <?php echo $total_movies_count ?> (<?php echo round(($total_movies_count - $month_movies_count) / $total_movies_count * 100) ?>%)</span>
                                    </div>
                                    <div>
                                        <div style="--color: blue;"></div>
                                        <span>Mes: <?php echo $month_movies_count ?> (<?php echo round($month_movies_count / $total_movies_count * 100) ?>%)</span>
                                    </div>
                                </div>
                                <div class="pie">
                                    <div class="part one" style="--color: blue; --percentage: <?php echo $month_movies_count / $total_movies_count * 100 ?>;"></div>
                                    <div class="part two" style="--color: red; --percentage: <?php echo ($total_movies_count - $month_movies_count) / $total_movies_count * 100 ?>;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="users_section">
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Email</th>
                            <th>Clave</th>
                            <th>Nacimiento</th>
                            <th>Pais</th>
                            <th>Rol</th>
                            <th>Fecha de Creacion</th>
                            <th>Editar</th>
                            <th>Borrar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) { ?>
                            <tr>
                                <form>
                                    <td class="id"><?php echo $user[0] ?></td>
                                    <td>
                                        <input disabled type="text" name="name" value="<?php echo $user[1] ?>">
                                    </td>
                                    <td>
                                        <input disabled type="text" name="surname" value="<?php echo $user[2] ?>">
                                    </td>
                                    <td>
                                        <input disabled type="text" name="email" value="<?php echo $user[3] ?>">
                                    </td>
                                    <td>
                                        <span><?php for ($i = 0; $i < strlen($user[4]); $i++) {
                                                    echo "*";
                                                } ?></span>
                                    </td>
                                    <td>
                                        <input disabled type="date" name="date" value="<?php echo $user[5] ?>">
                                    </td>
                                    <td>
                                        <select disabled name="country">
                                            <option <?php echo ($user[6] === "Argentina") ? "selected" : "" ?> value="Argentina">Argentina</option>
                                            <option <?php echo ($user[6] === "Bolivia") ? "selected" : "" ?> value="Bolivia">Bolivia</option>
                                            <option <?php echo ($user[6] === "Brasil") ? "selected" : "" ?> value="Brasil">Brasil</option>
                                            <option <?php echo ($user[6] === "Chile") ? "selected" : "" ?> value="Chile">Chile</option>
                                            <option <?php echo ($user[6] === "Colombia") ? "selected" : "" ?> value="Colombia">Colombia</option>
                                            <option <?php echo ($user[6] === "Ecuador") ? "selected" : "" ?> value="Ecuador">Ecuador</option>
                                            <option <?php echo ($user[6] === "Paraguay") ? "selected" : "" ?> value="Paraguay">Paraguay</option>
                                            <option <?php echo ($user[6] === "Peru") ? "selected" : "" ?> value="Peru">Peru</option>
                                            <option <?php echo ($user[6] === "Uruguay") ? "selected" : "" ?> value="Uruguay">Uruguay</option>
                                            <option <?php echo ($user[6] === "Venezuela") ? "selected" : "" ?> value="Venezuela">Venezuela</option>
                                        </select>
                                        <div class="arrow"></div>
                                    </td>
                                    <td>
                                        <select disabled name="role">
                                            <option value="0" <?php echo ($user[7] == 0) ? "selected" : "" ?>>usuario</option>
                                            <option value="1" <?php echo ($user[7] == 1) ? "selected" : "" ?>>admin</option>
                                        </select>
                                        <div class="arrow"></div>
                                    </td>
                                    <td>
                                        <?php echo $user[8] ?>
                                    </td>
                                    <td>
                                        <div>
                                            <button class="edit" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256">
                                                    <path fill="currentColor" d="m229.66 58.34l-32-32a8 8 0 0 0-11.32 0l-96 96A8 8 0 0 0 88 128v32a8 8 0 0 0 8 8h32a8 8 0 0 0 5.66-2.34l96-96a8 8 0 0 0 0-11.32M124.69 152H104v-20.69l64-64L188.69 88ZM200 76.69L179.31 56L192 43.31L212.69 64ZM224 128v80a16 16 0 0 1-16 16H48a16 16 0 0 1-16-16V48a16 16 0 0 1 16-16h80a8 8 0 0 1 0 16H48v160h160v-80a8 8 0 0 1 16 0" />
                                                </svg>
                                            </button>
                                            <button type="submit" hidden>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                                    <path fill="none" stroke="currentColor" stroke-dasharray="24" stroke-dashoffset="24" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11L11 17L21 7">
                                                        <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.4s" values="24;0" />
                                                    </path>
                                                </svg>
                                            </button>
                                            <button type="reset" hidden>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M20 20L4 4m16 0L4 20" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                    <td>
                                        <button class="delete" type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256">
                                                <path fill="currentColor" d="M216 48h-40v-8a24 24 0 0 0-24-24h-48a24 24 0 0 0-24 24v8H40a8 8 0 0 0 0 16h8v144a16 16 0 0 0 16 16h128a16 16 0 0 0 16-16V64h8a8 8 0 0 0 0-16M96 40a8 8 0 0 1 8-8h48a8 8 0 0 1 8 8v8H96Zm96 168H64V64h128Zm-80-104v64a8 8 0 0 1-16 0v-64a8 8 0 0 1 16 0m48 0v64a8 8 0 0 1-16 0v-64a8 8 0 0 1 16 0" />
                                            </svg>
                                        </button>
                                    </td>
                                </form>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </section>
        </section>
        <section class="movie_section">
            <section class="movie_form">
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
            </section>
            <section class="movie_table">
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Titulo</th>
                            <th>Director</th>
                            <th>Genero</th>
                            <th>Estrellas</th>
                            <th>Publicacion</th>
                            <th>Imagen</th>
                            <th>Descripcion</th>
                            <th>Fecha de Creacion</th>
                            <th>Editar</th>
                            <th>Borrar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($movies as $movie) { ?>
                            <tr>
                                <form>
                                    <td class="id"><?php echo $movie[0] ?></td>
                                    <td>
                                        <input disabled type="text" name="title" value="<?php echo $movie[1] ?>">
                                    </td>
                                    <td>
                                        <input disabled type="text" name="director" value="<?php echo $movie[2] ?>">
                                    </td>
                                    <td>
                                        <input disabled type="text" name="genre" value="<?php echo $movie[3] ?>">
                                    </td>
                                    <td>
                                        <input disabled type="number" name="rating" value="<?php echo $movie[4] ?>">
                                    </td>
                                    <td>
                                        <input disabled type="date" name="date" value="<?php echo $movie[5] ?>">
                                    </td>
                                    <td>
                                        <input id="movie-<?php echo $movie[0] ?>-file" disabled hidden type="file" name="file" image="<?php echo $movie[6] ?>">
                                        <label for="movie-<?php echo $movie[0] ?>-file">
                                            <a href="./movie_image.php?id=<?php echo $movie[6] ?>" target="_blank"><?php echo get_image_name($movie[6]) ?></a>
                                            <svg class="upload" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                    <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z" />
                                                    <path d="M14 2v4a2 2 0 0 0 2 2h4m-8 4v6m3-3l-3-3l-3 3" />
                                                </g>
                                            </svg>
                                        </label>
                                    </td>
                                    <td>
                                        <input disabled type="text" name="description" value="<?php echo $movie[7] ?>">
                                    </td>
                                    <td>
                                        <?php echo $movie[8] ?>
                                    </td>
                                    <td>
                                        <div>
                                            <button class="edit" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256">
                                                    <path fill="currentColor" d="m229.66 58.34l-32-32a8 8 0 0 0-11.32 0l-96 96A8 8 0 0 0 88 128v32a8 8 0 0 0 8 8h32a8 8 0 0 0 5.66-2.34l96-96a8 8 0 0 0 0-11.32M124.69 152H104v-20.69l64-64L188.69 88ZM200 76.69L179.31 56L192 43.31L212.69 64ZM224 128v80a16 16 0 0 1-16 16H48a16 16 0 0 1-16-16V48a16 16 0 0 1 16-16h80a8 8 0 0 1 0 16H48v160h160v-80a8 8 0 0 1 16 0" />
                                                </svg>
                                            </button>
                                            <button type="submit" hidden>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                                    <path fill="none" stroke="currentColor" stroke-dasharray="24" stroke-dashoffset="24" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11L11 17L21 7">
                                                        <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.4s" values="24;0" />
                                                    </path>
                                                </svg>
                                            </button>
                                            <button type="reset" hidden>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M20 20L4 4m16 0L4 20" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                    <td>
                                        <button class="delete" type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256">
                                                <path fill="currentColor" d="M216 48h-40v-8a24 24 0 0 0-24-24h-48a24 24 0 0 0-24 24v8H40a8 8 0 0 0 0 16h8v144a16 16 0 0 0 16 16h128a16 16 0 0 0 16-16V64h8a8 8 0 0 0 0-16M96 40a8 8 0 0 1 8-8h48a8 8 0 0 1 8 8v8H96Zm96 168H64V64h128Zm-80-104v64a8 8 0 0 1-16 0v-64a8 8 0 0 1 16 0m48 0v64a8 8 0 0 1-16 0v-64a8 8 0 0 1 16 0" />
                                            </svg>
                                        </button>
                                    </td>
                                </form>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </section>
        </section>
    </main>
    <footer>
    </footer>
    <script type="module" src="../assets/js/dashboard.js"></script>
<?php } ?>
<script type="module" src="../assets/js/global.js"></script>
</body>

</html>