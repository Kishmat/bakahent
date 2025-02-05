<?php
session_start();
if(!isset($_SESSION['user']) || $_SESSION['user'] != 645)
{
    header("Location: ../index.php");
    die;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPLOAD FOR ADMIN</title>
    <style>
        *{
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }
        body{
            background: #171717;
        }
        div{
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100vh;
            gap: 50px;
        }
        button{
            border: none;
            padding: 15px 25px;
            background: #395de8;
            color: white;
            border-radius: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div>
        <button onclick="location.href = 'upload_list.php';">Anime List</button>
        <button onclick="location.href = 'upload_anime.php';">Anime Episode</button>
        <button onclick="location.href = 'upload_cover.php';">Anime Trend</button>
    </div>
</body>
</html>