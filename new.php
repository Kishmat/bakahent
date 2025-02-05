<?php
$table = 'anime_list';
if(isset($_GET['table']))
    $table = $_GET['table'];

require_once "classes/connect.php";
require_once "classes/connect.php";
$DB = new Database();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body{
            font-family: Arial, Helvetica, sans-serif;
            height: 100vh;
            background: #232323;
            color: white;
        }
        .options{
            margin-top: 50px;
            display: flex;
            gap: 25px;
            margin-bottom: 30px;
        }

        .options .option select{
            padding: 8px 15px;
            border-radius: 5px;
            border: none;
        }

        .form{
            display: flex;
            flex-direction: column;
            gap: 20px;
            width: 95%;
            margin: 0 auto;
            max-width: 650px;
            align-items: center;
        }

        .form .element{
            display: flex;
            flex-direction: column;
            width: 100%;
            gap: 10px;
        }
        .form .element span{
            font-size: 15px;
        }
        .form .element input{
            border: 1px solid;
            padding: 12px 15px;
            border-radius: 5px;
            background: transparent;
            color: white;
            outline: none;
        }
        .form .element button{
            border: none;
            padding: 15px 0;
            width: 200px;
            border-radius: 12px;
            margin: 0 auto;
            margin-top: 20px;
            background: #2064cf;
            color: white;
            cursor: pointer;
            font-size: 15px;
        }
    </style>
</head>
<body>
    <div class="options">
        <div class="option">
            <div class="option">
                Select Table : 
                <select id="table_name">
                    <option value="anime_list">Anime Lists</option>
                    <option value="popular">Popular</option>
                    <option value="season">Seasons</option>
                </select>
            </div>
        </div>
    </div>
    <form class="form" method="post">
        <div class="element">
            <span>Anime Name</span>
            <input type="text">
        </div>
        <div class="element">
            <span>Jp Name</span>
            <input type="text">
        </div>
        <div class="element">
            <span>Status</span>
            <input type="text">
        </div>
        <div class="element">
            <span>Studio</span>
            <input type="text">
        </div>
        <div class="element">
            <span>Theme</span>
            <input type="text">
        </div>
        <div class="element">
            <span>Seasons</span>
            <input type="text">
        </div>
        
        <div class="element">
            <span>Summary</span>
            <textarea></textarea>
        </div>

        <div class="element">
            <span>Anime Name</span>
            <input type="text">
        </div>
        <div class="element">
            <button type="submit">Add Record</button>
        </div>
    </form>
</body>
</html>