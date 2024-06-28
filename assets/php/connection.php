<?php
include "./tables/user.php";

class Connection
{
    public $database = "cac";
    public $hostname = "localhost";
    public $username = "root";
    public $password = "root";
    // public $database = "id22319483_cac";
    // public $hostname = "localhost";
    // public $username = "id22319483_cac";
    // public $password = "Group18!";

    function updateQuery($str)
    {
        $connection = mysqli_connect($this->hostname, $this->username, $this->password, $this->database);
        $id = "";

        if ($connection->query($str) === TRUE) {
            $id = mysqli_insert_id($connection);
        }

        mysqli_close($connection);

        return $id;
    }

    function selectQuery($str)
    {
        $connection = mysqli_connect($this->hostname, $this->username, $this->password, $this->database);

        $query = mysqli_query($connection, $str);

        $results = array();
        while ($result = mysqli_fetch_array($query, PDO::FETCH_ASSOC)) {
            array_push($results, $result);
        }

        mysqli_close($connection);

        return $results;
    }
}