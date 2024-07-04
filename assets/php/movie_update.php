<?php
include_once "./connection.php";

$id = $_POST["id"];
$title = $_POST["title"];
$director = $_POST["director"];
$genre = $_POST["genre"];
$rating = $_POST["rating"];
$date = $_POST["date"];
$description = base64_encode($_POST["description"]);
$connect = new Connection();

$image_id = $_POST["image_id"];
$file = $_FILES["file"];
if (!empty($file) && !empty($image_id)) {
    $name = $file["name"];
    $content = base64_encode(file_get_contents($file["tmp_name"]));
    $type = $file["type"];

    $result = $connect->updateQuery("update image set name = '$name', content = '$content', type = '$type' where id = $image_id");
}

$connect->updateQuery("update movie set title = '$title', director = '$director', genre = '$genre', rating = '$rating', date = '$date', description = '$description' where id = $id");