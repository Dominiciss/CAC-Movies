<?php if (!session_id()) session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="../public/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,300&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/login.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php include_once "./fragments/navbar.php" ?>
    <main>
        <div class="card">
            <h6>Iniciar Sesión</h6>
            <form class="login" action="#" method="POST">
                <div class="input">
                    <span class="error hidden">El email no puede estar vacio y tiene que ser valido</span>
                    <input name="email" type="text" placeholder=" " form="novalidate">
                    <label for="email">Email</label>
                </div>
                <div class="input">
                    <span class="error hidden">La clave tiene que tener mas de 4 caracteres</span>
                    <input name="password" type="password" placeholder=" " form="novalidate">
                    <div class="eye"></div>
                    <label>Clave</label>
                </div>
                <div class="button">
                    <button type="submit">Iniciar Sesión</button>
                </div>
                <a class="help" href="./register.php">¿No tienes una cuenta? Regístrate</a>
            </form>
        </div>
        <div class="loader-wrapper" hidden>
            <div class="loader-background">
                <div class="loader"></div>
            </div>
        </div>
    </main>
    <footer>
    </footer>
    <script type="module" src="../assets/js/global.js"></script>
    <script type="module" src="../assets/js/login.js"></script>
</body>

</html>