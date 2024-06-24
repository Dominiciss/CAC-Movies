<?php
session_start();

// Verificar que los datos del formulario están presentes
if (isset($_POST["email"]) && isset($_POST["password"])) {
   // Conexión a la base de datos
   $con = mysqli_connect("localhost", "root", "", "movies_cac");

   if (!$con) {
      die("Error en la conexión al servidor: " . mysqli_connect_error());
   }

   //Escapar de manera segura los datos del formulario
   $email = mysqli_real_escape_string($con, $_POST["email"]);
   $password = mysqli_real_escape_string($con, $_POST["password"]);

   //Preparar la consulta
   $sql = "SELECT * FROM user WHERE email = ? AND password = ?";
   $stmt = mysqli_prepare($con, $sql);

   if (!$stmt) {
      die("Error en la preparación de la consulta: " . mysqli_error($con));
   }

   // Vincular los parámetros y ejecutar la consulta
   mysqli_stmt_bind_param($stmt, 'ss', $email, $password);
   mysqli_stmt_execute($stmt);
   $result = mysqli_stmt_get_result($stmt);

   if (!$result) {
      die("Error en la ejecución de la consulta: " . mysqli_error($con));
   }

   // Verificar si se encontró un usuario y gestionar la sesión
   if ($filas = mysqli_fetch_array($result)) {
      $_SESSION["email"] = $email;

      if ($filas['rol_id'] == 1) { // admin
         header('Location: ../../admin/dashboard.php');
         exit();
      } else if ($filas['rol_id'] == 2) { // user
         header('Location: ../../index.php');
         exit();
      } else {
         echo "<h1 class='bad'>ERROR EN LA AUTENTICACIÓN: Rol no reconocido</h1>";
      }
   } else {
      echo "<h1 class='bad'>ERROR EN LA AUTENTICACIÓN: Usuario o contraseña incorrectos</h1>";
   }

   // Cerrar la conexión
   mysqli_stmt_close($stmt);
   mysqli_close($con);
} else {
   echo "Error en el registro de usuarios: Faltan datos del formulario";
}
