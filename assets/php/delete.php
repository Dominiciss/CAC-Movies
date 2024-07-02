<?php
include_once "./connection.php";

$id = $_POST["id"];
$connect = new Connection();

$result = $connect->updateQuery("delete from user where id = $id");