<?php
include "./connection.php";

$name = $_POST["name"];
$surname = $_POST["surname"];
$email = $_POST["email"];
$password = $_POST["password"];
$date = $_POST["date"];
$country = $_POST["country"];
$connect = new Connection();

$result = $connect->updateQuery("insert into user (name, surname, email, password, date, country) VALUES ('$name', '$surname', '$email', '$password', '$date', '$country')");