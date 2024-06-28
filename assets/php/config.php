<?php 
include "./tables/user.php";
if (!session_id()) session_start();

$user = "";
if (!isset($_SESSION["user"])) {
    $_SESSION["user"] = $user;
}

function debug_to_console($data, $type = 0)
{
    $output = $data;
    if (is_array($output)) {
        $output = implode(',', $output);
    }

    echo ($type == 0) ? "<script>console.log('" . $output . "');</script>" : "<script>console.error('" . $output . "');</script>";
}
