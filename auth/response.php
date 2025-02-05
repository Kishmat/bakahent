<?php
session_start();
include_once "../classes/connect.php";
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $DB = new Database();
    $query = "select id from users where userid = '$_POST[id]' limit 1";
    $result = $DB->read($query);
    if(is_array($result))
    {
        $_SESSION['user'] = $_POST['id'];
        header("Location: ../index.php");
        die;
    }else{
        header("Location: ../logout.php");
        die;
    }
}