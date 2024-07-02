<?php
include_once "./config.php";
if (!session_id()) session_start();

$user = "";
if (isset($_SESSION["user"])) {
    $_SESSION["user"] = $user;
}