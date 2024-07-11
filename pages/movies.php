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
                <a href="./movie.php?id=<?php echo $movie[0] ?>" class="item" style="background-image: url('<?php echo get_movie_image($movie[6]) ?>')">
                    <div class="information">
                        <span class="title"><?php echo $movie[1] ?></span>
                        <span class="director"><?php echo $movie[2] ?></span>
                        <span class="rating"><?php echo $movie[4] ?>⭐</span>
                    </div>
                </a>
            <?php } ?>
        </ul>
    </main>
    <footer>
        <ul>
            <li>
                <span>Contribuidores</span>
            </li>
            <li>
                <a href="https://www.linkedin.com/in/lucila-kerstin-werner-278b3026/" target="_blank">
                    <img src="https://media.licdn.com/dms/image/D4E03AQEOKEwfAu1bBA/profile-displayphoto-shrink_200_200/0/1679856557410?e=1726099200&v=beta&t=r7POQzPpmzVcXExDoMYgOMT6o4BT0d7PWJ3eOnjfTbI" alt="Foto lucila">
                    Lucila K. Werner
                </a>
            </li>
            <li>
                <a href="https://www.linkedin.com/in/manuel-dominich-martinez/" target="_blank">
                    <img src="https://media.licdn.com/dms/image/D4E03AQF-GKkQnD-bZA/profile-displayphoto-shrink_800_800/0/1699454678577?e=1726099200&v=beta&t=xzL7HDmaMCkLN4v1KJxHuBpdHOUtkVhdPIEfYXOd_o4" alt="Foto manuel">
                    Manuel Dominich M.
                </a>
            </li>
            <li>
                <a href="https://www.linkedin.com/in/cinthia-orona85/" target="_blank">
                    <img src="https://media.licdn.com/dms/image/D4E35AQHIqGEOAmiB-Q/profile-framedphoto-shrink_800_800/0/1677696984240?e=1721257200&v=beta&t=utwdK1Tic4PBBQnNh2tyD8ai7MkBXjC9j_a5vVQKn84" alt="Foto cinthia">
                    Cinthia M. Orona
                </a>
            </li>
            <li>
                <a>
                    <img src="https://media-eze1-1.cdn.whatsapp.net/v/t61.24694-24/439361826_1862237447584154_4360063131333885870_n.jpg?ccb=11-4&oh=01_Q5AaIL1RlVwc_9ruBI98H8PfmAQyindvjdTgVIBD0RP480HT&oe=669C15EF&_nc_sid=e6ed6c&_nc_cat=100" alt="Foto lucas">
                    Lucas
                </a>
            </li>
        </ul>
    </footer>
    <script type="module" src="./../assets/js/global.js"></script>
    <script type="module" src="./../assets/js/movies.js"></script>
</body>

</html>