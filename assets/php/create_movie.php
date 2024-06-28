<?php
include "./connection.php";

$title = $_POST["title"];
$director = $_POST["director"];
$genre = $_POST["genre"];
$rating = $_POST["rating"];
$date = $_POST["date"];
$connect = new Connection();

$file = $_FILES["file"];
$name = $file["name"];
$content = base64_encode(file_get_contents($file["tmp_name"]));
$type = $file["type"];

$result = $connect->updateQuery("insert into image (name, content, type) VALUES ('$name', '$content', '$type')");

$connect->updateQuery("insert into movie (title, director, genre, rating, date, image_id) VALUES ('$title', '$director', '$genre', '$rating', '$date', '$result')");