<?php
include "./tables/user.php";

class Connection
{
    public $database = "cac";
    public $hostname = "localhost";
    public $username = "root";
    public $password = "root";

    function updateQuery($str)
    {
        $connection = mysqli_connect($this->hostname, $this->username, $this->password, $this->database);

        if ($connection->query($str) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $str . "<br>" . $connection->error;
            return false;
        }

        mysqli_close($connection);

        return true;
    }

    function selectQuery($str)
    {
        $connection = mysqli_connect($this->hostname, $this->username, $this->password, $this->database);

        $query = mysqli_query($connection, $str);

        $results = array();
        while ($result = mysqli_fetch_array($query)) {
            $user = new User($result["id"], $result["name"], $result["surname"], $result["email"], $result["password"], $result["date"], $result["country"], $result["creation_time"]);
            array_push($results, $user);
        }

        mysqli_close($connection);

        return $results;
    }
}