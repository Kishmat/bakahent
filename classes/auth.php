<?php
session_start();
require_once "connect.php";
function check_login()
{
    if (isset($_SESSION['user'])) {
        return $_SESSION['user'];
    } else {
        return false;
    }
}
function login($data)
{
    $error = "";
    $email = addslashes($data['email']);
    $password = addslashes($data['pass']);
    $query = "select * from users where email = '$email' limit 1";
    $DB = new Database();
    $result = $DB->read($query);
    if ($result) {
        $row = $result[0];
        if (hash("sha1", $password) == $row['pass']) {
            $_SESSION['user'] = $row['userid'];
            if (isset($data['remember']) && $data['remember'] == "on") {
                return "success";
            } else {
                return "no";
            }

        } else {
            $error .= "Either email or password is incorrect!";
        }

    } else {
        $error .= "Either email or password is incorrect!";
    }
    return $error;
}


function signup($data)
{
    $error = 0;
    $DB = new Database();
    foreach ($data as $key => $value) {
        if ($key == "fname") {
            if (is_numeric($value) || strstr($value, " ") || preg_match('~[0-9]+~', $value)) {
                $error = 1;
            }
        }
        if ($key == "lname") {
            if (is_numeric($value) || strstr($value, " ") || preg_match('~[0-9]+~', $value)) {
                $error = 2;
            }
        }
    }

    if ($error == 0) {
        $query = "select * from users where email = '$data[email]' limit 1";
        $result = $DB->read($query);
        if (is_array($result)) {
            $error = 4;
            return $error;
        } else {
            $password = hash("sha1", $data['pass']);
            $fname = $data['fname'];
            $lname = $data['lname'];
            $email = $data['email'];
            top:
            $userid = create_id();
            $query = "select * from users where userid = '$userid' limit 1";
            $result = $DB->read($query);
            if (is_array($result)) {
                goto top;
            } else {
                $query = "insert into users (userid,fname,lname,email,pass) values 
                ('$userid','$fname','$lname','$email','$password')";
                $DB->save($query);
            }
        }
    } else {
        return $error;
    }
}
function create_id()
{
    $length = rand(4, 6);
    $num = "";
    for ($i = 0; $i < $length; $i++) {
        $rand1 = rand(0, 9);
        $num = $num . $rand1;
    }
    if($num != 645)
        return $num;
    else
        return create_id();
}