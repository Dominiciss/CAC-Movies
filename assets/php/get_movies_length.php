<?php
include_once "./connection.php";

$connect = new Connection();

$result = $connect->selectQuery("select count(id) from movie");

echo $result[0][0];
