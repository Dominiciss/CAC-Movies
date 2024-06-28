<?php
include "./connection.php";

$id = $_POST["id"];
$connect = new Connection();

$result = $connect->selectQuery("select * from image where id = $id");

$type = $result[0][3];

echo "data:$type;base64," . stripslashes($result[0][2]);