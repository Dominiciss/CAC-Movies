<?php
include "./config.php";

class Connection
{
    public $database = "cac";
    public $hostname = "localhost";
    public $username = "root";
    public $password = "root";

    function executeQuery($str)
    {
        $connection = mysqli_connect($this->hostname, $this->username, $this->password, $this->database);

        if (mysqli_connect_errno()) {
            debug_to_console("Couldn't connect: " . mysqli_connect_errno(), 1);
        } else {
            debug_to_console("Successfully connected");
        }

        if ($connection->query($str) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $str . "<br>" . $connection->error;
        }

        // while ($result = mysqli_fetch_array($query)) {
        //     echo $result["name"];
        // }
        // debug_to_console($result);

        mysqli_close($connection);

        return true;
    }
}
