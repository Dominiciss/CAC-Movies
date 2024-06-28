<?php
include "./connection.php";

$connect = new Connection();

$result = $connect->selectQuery("select * from movie");

echo json_encode($result);