<?php
include_once "./connection.php";

$id = $_POST["id"];
$name = $_POST["name"];
$surname = $_POST["surname"];
$email = $_POST["email"];
$date = $_POST["date"];
$country = $_POST["country"];
$role = $_POST["role"];
$connect = new Connection();

$result = $connect->updateQuery("update user set name = '$name', surname = '$surname', email = '$email', date = '$date', country = '$country', role = $role where id = $id");