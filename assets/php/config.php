<?php
function debug_to_console($data, $type = 0)
{
    $output = $data;
    if (is_array($output)) {
        $output = implode(',', $output);
    }

    echo ($type == 0) ? "<script>console.log('" . $output . "');</script>" : "<script>console.error('" . $output . "');</script>";
}
