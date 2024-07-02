<?php
include_once "./connection.php";

$connect = new Connection();

$result = $connect->selectQuery("select email from user");

echo json_encode($result);
