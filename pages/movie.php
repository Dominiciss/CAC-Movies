<?php if (!session_id()) session_start() ?>
<?php
include_once "./../assets/php/connection.php";

$movie = get_movie($_GET["id"]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="../public/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,300&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/movie.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php include_once "./fragments/navbar.php" ?>
    <main>
        <section class="main-section">
            <div class="image">
                <img src="" alt="<?php echo $movie[1] ?>">
            </div>
            <div class="information">
                <h4 class="title"><?php echo $movie[1] ?></h4>
                <div class="data">
                    <span class="date"><?php echo $movie[5] ?></span>
                    <span class="divider">•</span>
                    <span class="genre"><?php echo $movie[3] ?></span>
                    <span class="divider">•</span>
                    <span class="rating"><?php echo "$movie[4] ⭐" ?></span>
                </div>
                <br>
                <h6>Overview</h6>
                <span class="description"><?php echo (empty($movie[7])) ? "No se ha provisto una descripcion." : $movie[7] ?></span>
                <br>
                <h6>Director</h6>
                <span class="director"><?php echo $movie[2] ?></span>
            </div>
        </section>
    </main>
    <footer>
    </footer>
    <script type="module" src="../assets/js/global.js"></script>
    <script type="module" src="../assets/js/movie.js"></script>
    <script>
        async function get_image() {
            let formData = new FormData()

            formData.append("id", <?php echo $movie[6] ?>)

            const data = await fetch("./../assets/php/get_movie_image.php", {
                method: 'POST',
                body: formData
            }).then(response => response.text())
            document.querySelector(".main-section").style.background = `linear-gradient(to right top, #6d6969a7, #6d6969a7), url(${data})`
            document.querySelector(".main-section .image img").src = `${data}`
        }
        get_image()
    </script>
</body>

</html>