<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Verifica si las variables estan definidias. Si estan les asigna su valor sino le asigna una cadena vacia
$nameErr = isset($_SESSION['nameErr']) ? $_SESSION['nameErr'] : "";
$surnameErr = isset($_SESSION['surnameErr']) ? $_SESSION['surnameErr'] : "";
$emailErr = isset($_SESSION['emailErr']) ? $_SESSION['emailErr'] : "";
$password1Err = isset($_SESSION['password1Err']) ? $_SESSION['password1Err'] : "";
$password2Err= isset($_SESSION['password2Err']) ? $_SESSION['password2Err'] : "";
$dateErr= isset($_SESSION['dateErr']) ? $_SESSION['dateErr'] : "";
$countryErr= isset($_SESSION['countryErr']) ? $_SESSION['countryErr'] : "";
$termsErr= isset($_SESSION['termsErr']) ? $_SESSION['termsErr'] : "";
$name = isset($_SESSION['name']) ? $_SESSION['name'] : "";
$surname = isset($_SESSION['surname']) ? $_SESSION['surname'] : "";
$email = isset($_SESSION['email']) ? $_SESSION['email'] : "";
$password1= isset($_SESSION['password1']) ? $_SESSION['password1'] : "";
$password2= isset($_SESSION['password2']) ? $_SESSION['password2'] : "";
$date= isset($_SESSION['date']) ? $_SESSION['date'] : "";
//$country= isset($_SESSION['country']) ? $_SESSION['country'] : "";
$terms= isset($_SESSION['terms']) ? $_SESSION['terms'] : "";

// Limpiar errores y valores de la sesión después de usarlos
unset($_SESSION['nameErr']);
unset($_SESSION['surnameErr']);
unset($_SESSION['emailErr']);
unset($_SESSION['password1Err']);
unset($_SESSION['password2Err']);
unset($_SESSION['dateErr']);
unset($_SESSION['countryErr']);
unset($_SESSION['termsErr']);
unset($_SESSION['name']);
unset($_SESSION['surname']);
unset($_SESSION['email']);
unset($_SESSION['password1']);
unset($_SESSION['password2']);
unset($_SESSION['date']);
//unset($_SESSION['country']);
unset($_SESSION['terms']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="shortcut icon" href="../public/favicon.ico" type="image/x-icon">
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,300&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/register.css">
</head>

<body>
    <header>
        <nav>
            <ul class="left">
                <li>
                    <a href="../" class="home"><svg style="pointer-events: none" xmlns="http://www.w3.org/2000/svg"
                            width="1em" height="1em" viewBox="0 0 24 24">
                            <g fill="none">
                                <path
                                    d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022m-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                                <path fill="currentColor"
                                    d="M20 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2zm-4 2H8v14h8zm4 12h-2v2h2zM6 17H4v2h2zm14-4h-2v2h2zM6 13H4v2h2zm14-4h-2v2h2zM6 9H4v2h2zm14-4h-2v2h2zM6 5H4v2h2z" />
                            </g>
                        </svg> <span>CAC-Movies</span></a>
                </li>
            </ul>
            <ul class="mid">
            </ul>
            <div class="right">
                <ul id="dropdown-menu">
                    <li>
                        <a href="./login.php">Iniciar Sesión</a>
                    </li>
                </ul>
            </div>
            <button type="button" class="dropdown"><svg style="pointer-events: none;" xmlns="http://www.w3.org/2000/svg"
                    width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" fill-rule="evenodd"
                        d="M20.75 7a.75.75 0 0 1-.75.75H4a.75.75 0 0 1 0-1.5h16a.75.75 0 0 1 .75.75m0 5a.75.75 0 0 1-.75.75H4a.75.75 0 0 1 0-1.5h16a.75.75 0 0 1 .75.75m0 5a.75.75 0 0 1-.75.75H4a.75.75 0 0 1 0-1.5h16a.75.75 0 0 1 .75.75"
                        clip-rule="evenodd" />
                </svg></button>
        </nav>
    </header>
    <main>
        <div class="card">
            <h6>Registro</h6>
            <form class="register" action="receive.php" method="POST">
            <div class="input">
                    <?php if (!empty($nameErr)): ?>
                        <span class="error"><?php echo $nameErr; ?></span>
                    <?php endif; ?>
                    <input class="input-data" name="name" type="text" placeholder=" " value="<?php echo htmlspecialchars($name); ?>">
                    <label>Nombre</label>
                </div>           
        <div class="input">
                    <?php if (!empty($surnameErr)): ?>
                        <span class="error"><?php echo $surnameErr; ?></span>
                    <?php endif; ?>
                    <input class="input-data" name="surname" type="text" placeholder=" " value="<?php echo htmlspecialchars($surname); ?>">
                    <label>Apellido</label>
                </div>
            <div class="input">
            <?php if (!empty($emailErr)): ?>
                        <span class="error"><?php echo $emailErr; ?></span>
                    <?php endif; ?>
                    <input class="input-data" name="email" type="email" placeholder=" " value="<?php echo htmlspecialchars($email); ?>">
                    <label for="email">Email</label>
                </div>
                 <div class="input">
                 <?php if (!empty($password1Err)): ?>
                        <span class="error"><?php echo $password1Err; ?></span>
                    <?php endif; ?>
                    <input class="input-data" name="password1" type="password" placeholder=" " value="<?php echo htmlspecialchars($password1); ?>">
                    <label>Clave</label>
                </div>
                <div class="input">
                <?php if (!empty($password2Err)): ?>
                        <span class="error"><?php echo $password2Err; ?></span>
                    <?php endif; ?>
                    <input class="input-data" name="password2" type="password" placeholder=" " value="<?php echo htmlspecialchars($password2); ?>">
                    <label>Repita la clave</label>
                </div>
                <div class="input-date">
                <?php if (!empty($dateErr)): ?>
                        <span class="error"><?php echo $dateErr; ?></span>
                    <?php endif; ?>
                    <input class="input-data" name="date" type="date" placeholder=" " value="<?php echo htmlspecialchars($date); ?>">
                    <label>Fecha de nacimiento</label>
                </div>
                <div class="input-country">
                 <?php if (!empty($countryErr)): ?>
                        <span class="error"><?php echo $countryErr; ?></span>
                    <?php endif; ?>
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
                    <?php if (!empty($termsErr)): ?>
                        <span class="error"><?php echo $termsErr; ?></span>
                    <?php endif; ?>
                    <input class="input-data" name="terms" type="checkbox" value="1" <?php if (!empty($terms)) echo "checked"; ?>>
                    <span>Acepto términos y condiciones</span>
                </div>                
                <div class="button">
                    <button type="submit">Registrarse</button>
                </div>
                <a class="help" href="#">Necesitas ayuda?</a>
            </form>
        </div>
    </main>
    <footer>
    </footer>

    <!--<script src="../assets/js/register.js"></script>-->
</body>

</html>