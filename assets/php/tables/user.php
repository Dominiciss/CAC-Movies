<?php
class User
{
    public $id;
    public $name;
    public $surname;
    public $email;
    public $password;
    public $date;
    public $country;
    public $creation_time;

    function __construct($id = "", $name = "", $surname = "", $email = "", $password = "", $date = "", $country = "", $creation_time = "")
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->password = $password;
        $this->date = $date;
        $this->country = $country;
        $this->creation_time = $creation_time;
    }

    function get_id()
    {
        return $this->id;
    }

    function set_id($id)
    {
        $this->id = $id;
    }

    function get_name()
    {
        return $this->name;
    }

    function set_name($name)
    {
        $this->name = $name;
    }

    function get_surname()
    {
        return $this->surname;
    }

    function set_surname($surname)
    {
        $this->surname = $surname;
    }

    function get_email()
    {
        return $this->email;
    }

    function set_email($email)
    {
        $this->email = $email;
    }

    function get_password()
    {
        return $this->password;
    }

    function set_password($password)
    {
        $this->password = $password;
    }

    function get_date()
    {
        return $this->date;
    }

    function set_date($date)
    {
        $this->date = $date;
    }

    function get_country()
    {
        return $this->country;
    }

    function set_country($country)
    {
        $this->country = $country;
    }

    function get_creation_time()
    {
        return $this->creation_time;
    }

    function set_creation_time($creation_time)
    {
        $this->creation_time = $creation_time;
    }

    function __toString()
    {
        return "User { id: $this->id, name: $this->name, surname: $this->surname, email: $this->email, password: $this->password, date: $this->date, country: $this->country, creation_time: $this->creation_time }";
    }
}
