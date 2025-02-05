<?php
session_start();
if(!isset($_SESSION['user']) || $_SESSION['user'] != 645)
{
    header("Location: ../index.php");
    die;
}
require_once "../classes/connect.php";
$DB = new Database();
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $anime_id = $_POST['anime_id'];
    $id_name = addslashes($_POST['id_name']);
    $sname = addslashes($_POST['sname']);
    $season = $_POST['season'];
    $eps = $_POST['eps'];
    $aired = $_POST['aired'];
    $query = "insert into season (anime_id,season,id_name,season_name,ep,aired_ep) values ('$anime_id','$season','$id_name','$sname','$eps','$aired')";
    $DB->save($query);
    header("Location: new.php");
    die;
}
$query = "select anime_id,name,seasons from anime_list order by id desc limit 5";
$lists = $DB->read($query);
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>upload</title>
        <style>
            *{
                margin: 0;
                font-family: arial;
            }
            form{
                display: flex;
                flex-direction: column;
                gap: 20px;
                width: 640px;
                margin: 20px auto;
                border: 1px solid black;
                padding: 10px 20px;
                border-radius: 12px;
            }
            input{
                padding: 5px 10px;
            }
            button{
                padding: 20px 20px;
                width: 240px;
                margin: 0 auto;
                display: block;
                color: white;
                border: none;
                background: blue;
                cursor: pointer;
                border-radius: 12px;
            }
        </style>
    </head>
    <body>
        <form method="post" id="new">
            Anime Id : 
            <select name="anime_id">
                <?php 
                    foreach($lists as $list)
                    {
                        echo "<option value='$list[anime_id]'>$list[name]</option>";
                    }
                ?>
            </select>
            Id Name : <input type="text" name="id_name" placeholder="Anime Token">
            Season_Name : <input type="text" name="sname">
            Season : <input type="number" name="season">
            Episode : <input type="number" name="eps">
            Aired_Ep : <input type="number" name="aired">
            <button type="submit">Upload</button>
        </form>
    </body>
</html>