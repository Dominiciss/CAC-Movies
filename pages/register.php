<?php if (!session_id()) session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="shortcut icon" href="../public/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,300&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/register.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php include_once "./fragments/navbar.php" ?>
    <main>
        <div class="card">
            <h6>Registro</h6>
            <form class="register" method="POST" novalidate>
                <div class="input">
                    <span class="error hidden">El nombre tiene que contener mas de 2 caracteres</span>
                    <input class="input-data" name="name" type="text" placeholder=" ">
                    <label>Nombre</label>
                </div>
                <div class="input">
                    <span class="error hidden">El apellido tiene que contener mas de 2 caracteres</span>
                    <input class="input-data" name="surname" type="text" placeholder=" ">
                    <label>Apellido</label>
                </div>
                <div class="input">
                    <span class="error hidden">El email no puede estar vacio y tiene que ser valido</span>
                    <input class="input-data" name="email" type="email" placeholder=" ">
                    <label for="email">Email</label>
                </div>
                <div class="input">
                    <span class="error hidden">La clave tiene que tener mas de 4 caracteres</span>
                    <input class="input-data" name="password1" type="password" placeholder=" ">
                    <div class="eye"></div>
                    <label>Clave</label>
                </div>
                <div class="input">
                    <span class="error hidden">La clave debe coincidir con la anterior</span>
                    <input class="input-data" name="password2" type="password" placeholder=" ">
                    <div class="eye"></div>
                    <label>Repita la clave</label>
                </div>
                <div class="input-date">
                    <span class="error hidden">Tiene que haber una fecha</span>
                    <input class="input-data" name="date" type="date" placeholder=" ">
                    <label>Fecha de nacimiento</label>
                </div>
                <div class="input-country">
                    <span class="error hidden">Tiene que haber un pais</span>
                    <select class="input-data" name="country">
                        <option hidden disabled selected value="">Elige un pais</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Bolivia">Bolivia</option>
                        <option value="Brasil">Brasil</option>
                        <option value="Chile">Chile</option>
                        <option value="Colombia">Colombia</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="Paraguay">Paraguay</option>
                        <option value="Peru">Peru</option>
                        <option value="Uruguay">Uruguay</option>
                        <option value="Venezuela">Venezuela</option>
                    </select>
                    <label>Pais</label>
                </div>
                <div class="check">
                    <span class="error hidden">Para crear una cuenta tienes que aceptar los terminos</span>
                    <input class="input-data" name="terms" type="checkbox">
                    <span>Acepto términos y condiciones</span>
                </div>
                <div class="button">
                    <button type="submit">Registrarse</button>
                </div>
                <a class="help" href="./login.php">¿Ya tienes una cuenta? Inicia sesión</a>
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
    <script src="../assets/js/global.js"></script>
    <script src="../assets/js/register.js"></script>
</body>

</html>