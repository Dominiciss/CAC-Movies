<?php

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

function get_total_users_count()
{
    $connection = new Connection();

    return $connection->selectQuery("select count(id) from user")[0][0];
}

function get_total_movies_count()
{
    $connection = new Connection();

    return $connection->selectQuery("select count(id) from movie")[0][0];
}

function get_today_users_count()
{
    $connection = new Connection();

    return $connection->selectQuery("select count(id) from user where date_format(creation_time, '%Y-%m-%d') = date_format(current_date, '%Y-%m-%d')")[0][0];
}

function get_today_movies_count()
{
    $connection = new Connection();

    return $connection->selectQuery("select count(id) from movie where date_format(creation_time, '%Y-%m-%d') = date_format(current_date, '%Y-%m-%d')")[0][0];
}

function get_month_users_count()
{
    $connection = new Connection();

    return $connection->selectQuery("select count(id) from user where date_format(creation_time, '%Y-%m') = date_format(current_date, '%Y-%m')")[0][0];
}

function get_month_movies_count()
{
    $connection = new Connection();

    return $connection->selectQuery("select count(id) from movie where date_format(creation_time, '%Y-%m') = date_format(current_date, '%Y-%m')")[0][0];
}

function get_role($id)
{
    $connection = new Connection();

    $result = $connection->selectQuery("select * from user where id = '$id'");

    if (is_array($result) && Sizeof($result) > 0 && $result[0] != null) {
        $role = $result[0][7];

        return $role;
    }
}

function get_movie($id)
{
    $connection = new Connection();

    $result = $connection->selectQuery("select * from movie where id = '$id'");

    if (is_array($result) && Sizeof($result) > 0 && $result[0] != null) {
        $movie = $result[0];

        return $movie;
    }
}

function get_users()
{
    $connection = new Connection();

    $result = $connection->selectQuery("select id, name, surname, email, password, date, country, role, date_format(creation_time, '%Y-%m-%d') from user");

    return $result;
}

function get_movies()
{
    $connection = new Connection();

    $result = $connection->selectQuery("select id, title, director, genre, rating, date, image_id, description, date_format(creation_time, '%Y-%m-%d') from movie");

    return $result;
}

function get_movie_image($id)
{
    $connect = new Connection();

    $result = $connect->selectQuery("select * from image where id = $id");

    $type = $result[0][3];

    echo "data:$type;base64," . stripslashes($result[0][2]);
}

function get_image_name($id)
{
    $connection = new Connection();

    $result = $connection->selectQuery("select name from image where id = $id");

    return $result[0][0];
}
