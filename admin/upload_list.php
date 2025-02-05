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
    $anime_id = generate_id();
    $name = $_POST['name'];
    $jp_name = $_POST['jp_name'];
    $st = $_POST['status'];
    $studio = $_POST['studio'];
    $theme = $_POST['theme'];
    $seasons = $_POST['seasons'];
    $adult = $_POST['adult'];
    $summary = addslashes($_POST['summary']);

    if(is_array($_FILES))
    {
        $ext = $_FILES['img']['type'];
        $filename = '';
        if($ext == "image/jpeg" || $ext == "image/png")
        {
            if($ext == "image/jpeg")
            {
                $filename = "anime/". $anime_id . ".jpg";
                move_uploaded_file($_FILES['img']['tmp_name'], "../".$filename);
            }else
            {
                $filename = "anime/" . $anime_id . ".png";
                move_uploaded_file($_FILES['img']['tmp_name'], "../".$filename);
            }
        }
        else{
            echo "<script>alert('Only JPG or PNG allowed');window.location.href = window.location.href;</script>";
            die;
        }
    }
    $query = "insert into anime_list (anime_id,name,jp_name,status,studio,theme,seasons,summary,img,adult) values ('$anime_id','$name','$jp_name','$st','$studio','$theme','$seasons','$summary','$filename','$adult')";
    $DB->save($query);
    header("Location: new.php");
    die;
}

function generate_id()
{
    $DB = new Database();
    $length = rand(4, 9);
    $num = "";
    for ($i = 0; $i < $length; $i++) {
        $rand1 = rand(0, 9);
        $num = $num . $rand1;
    }
    //generates random 4-9 letter code
    $sql = "select * from anime_list where anime_id='$num' limit 1";
    $data = $DB->read($sql); // checks if the code already exits
    if(is_array($data))
        generate_id(); // generates again if code matches with other anime
    else
        return $num; // returns the unique id
}

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
            Anime Name : <input type="text" name="name" placeholder="Anime Name">
            Japan Name : <input type="text" name="jp_name" placeholder="Japan Name">
            Status : <input type="text" name="status">
            Studio : <input type="text" name="studio">
            Theme : <textarea name="theme"></textarea>
            Seasons : <input type="number" name="seasons">
            Summary : <textarea name="summary"></textarea>
            Adult : <input type="text" name="adult">
            Image : <input type="file" name="img">
            <button type="submit">Upload</button>
        </form>
    </body>
</html>