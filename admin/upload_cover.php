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
    
    if(is_array($_FILES))
    {
        $ext = $_FILES['cover']['type'];
        $filename = '';
        if($ext == "image/jpeg" || $ext == "image/png")
        {
            if($ext == "image/jpeg")
            {
                $filename = "anime/". $anime_id . "_cover.jpg";
                move_uploaded_file($_FILES['cover']['tmp_name'], "../".$filename);
            }else
            {
                $filename = "anime/" . $anime_id . "_cover.png";
                move_uploaded_file($_FILES['cover']['tmp_name'], "../".$filename);
            }
        }
        else{
            echo "<script>alert('Only JPG or PNG allowed');window.location.href = window.location.href;</script>";
            die;
        }
    }
    $query = "insert into popular (anime_id,cover) values ('$anime_id','$filename')";
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
        <form method="post" enctype="multipart/form-data">
            Anime Id : <select name="anime_id">
                <?php 
                    foreach($lists as $list)
                    {
                        echo "<option value='$list[anime_id]'>$list[name]</option>";
                    }
                ?>
            </select>
            Cover : <input type="file" name="cover">
            <button type="submit">Upload</button>
        </form>
    </body>
</html>