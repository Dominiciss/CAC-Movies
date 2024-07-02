<?php
include_once "./connection.php";

$MOVIES_PER_PAGE = 8;
$page = ((int)$_GET["page"]);

$offset = ($page - 1) * $MOVIES_PER_PAGE;
$max_results = $MOVIES_PER_PAGE;

$connect = new Connection();

$result = $connect->selectQuery("select * from movie limit $offset, $max_results");

echo json_encode($result);
