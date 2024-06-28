<?php
include "./config.php";
if (!session_id()) session_start();

$user = $_SESSION["user"];
echo $user;


echo basename("create_movie.php");
