<?php
include "./connection.php";
if (!session_id()) session_start();

$email = $_POST["email"];
$password = $_POST["password"];
$connect = new Connection();

$result = $connect->selectQuery("select * from user where email = '$email' and password = '$password'");

$data = json_encode($result);

if (is_array($result) && Sizeof($result) > 0 && $result[0] != null) {
    $id = $result[0][0];

    $_SESSION["user"] = $id;
}

echo $data;