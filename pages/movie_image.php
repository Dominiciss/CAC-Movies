<?php
include_once "./../assets/php/connection.php";

$id = $_GET["id"];
$connect = new Connection();

$result = $connect->selectQuery("select * from image where id = $id");

$name = $result[0][1];
$type = $result[0][3];
$src = stripslashes($result[0][2]);

echo "<body style='margin: 0'> <img src='data:$type;base64,$src' alt='$name' style='max-width: 100vw; max-height: 100vh'> </body>";