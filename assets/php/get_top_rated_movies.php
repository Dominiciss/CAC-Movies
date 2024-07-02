<?php
include_once "./connection.php";

$connect = new Connection();

$result = $connect->selectQuery("select * from movie order by rating desc, date asc limit 12");

echo json_encode($result);
