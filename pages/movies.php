<?php
include_once "./../assets/php/config.php";
include_once "./../assets/php/connection.php";

$movies = get_movies();

$search = "";
if (!empty($_GET)) {
    $search = $_GET["search"];
}
?>
<?php if (!session_id()) session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peliculas</title>
    <link rel="shortcut icon" href="../public/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,300&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/movies.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php include_once "./fragments/navbar.php" ?>
    <main>
        <input type="text" name="search" placeholder="Busqueda" value="<?php echo $search ?>">
        <div class="no_results hidden">No se encontraron peliculas</div>
        <ul class="movie_container">
            <?php foreach ($movies as $movie) { ?>
                <li class="item" style="background-image: url('<?php echo get_movie_image($movie[6]) ?>')">
                    <div class="information">
                        <span class="title"><?php echo $movie[1] ?></span>
                        <span class="director"><?php echo $movie[2] ?></span>
                        <span class="rating"><?php echo $movie[4] ?>⭐</span>
                    </div>
                </li>
            <?php } ?>
        </ul>
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
    <script type="module" src="./../assets/js/global.js"></script>
    <script type="module" src="./../assets/js/movies.js"></script>
</body>

</html>