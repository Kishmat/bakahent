<?php
session_start();
if(!isset($_SESSION['user']))
{
    header("Location: index.php");
    die;
}
require_once "classes/connect.php";

$DB = new Database();
$query = "select remind,theme,region from users where userid='$_SESSION[user]' limit 1";
$result = $DB->read($query);

if(!is_array($result))
{
    header("Location: auth/login.php");
    die;
}
$result = $result[0];
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $remind = $_POST['remind'];
    $theme = $_POST['theme'];
    $region = $_POST['region'];
    $DB = new Database();
    $query = "update users set remind='$remind',theme='$theme',region='$region' where userid='$_SESSION[user]' limit 1";
    $DB->save($query);
    header("Location: settings.php");
    die;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.1.0/remixicon.css" integrity="sha512-dUOcWaHA4sUKJgO7lxAQ0ugZiWjiDraYNeNJeRKGOIpEq4vroj1DpKcS3jP0K4Js4v6bXk31AAxAxaYt3Oi9xw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@300;400;600&display=swap" rel="stylesheet">
<style>
    :root{
        --color-background: #202020;
        --color-text-nice: #d1caca;
        --color-background-2: #0a0a0a;
    }
        body{
            background: var(--color-background-2);
            height: calc(100vh - 70px);
        }

        .top{
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            color: white;
            padding: 18px 15px 15px 15px;
            width: 100%;
            position: relative;
            background: var(--color-background);
            position: fixed;
            top: -20px;
            z-index: 5;
        }
        .top i{
            font-size: 20px;
        }
        .top button{
            position: fixed;
            right: 0px;
            border: 0;
            padding: 3px 16px;
            border-radius: 6px;
            background: transparent;
            color: var(--color-second);
            font-size: 15px;
            cursor: pointer;
            top: 10px;
        }
        .top button:disabled{
            color:gray;
            cursor: not-allowed;
        }
        .top p{
            font-size: 16px;
        }
        .body{
            background: var(--color-background-2);
        }
        .body .infos{
            margin-top: 100px;
        }
        .body .infos ul li{ 
            color: white;
            padding: 15px;
            margin-bottom: 15px;
            margin-top: 15px;
            position: relative;
            border-radius: 9px;
            width: 92%;
            margin-left: auto;
            margin-right: auto;
            font-size: 15px;
            background: #353535bf;
        }
        .body .infos ul li input{
            position: absolute;
            right: 5px;
            width: 235px;
            border: none;
            background-color: transparent;
            color: var(--color-text-nice);
            font-size: 16px;
            text-align: right;
            font-family: arial;
            font-weight: 300;
            padding: 8px;
            top: 11px;
        }
        .body .infos ul li select{
            outline: none !important;
            position: absolute;
            right: 5px;
            width: 235px;
            border: none;
            background-color: #f000;
            color: var(--color-text-nice);
            font-size: 16px;
            text-align: right;
            font-family: arial;
            font-weight: 300;
            padding: 8px;
            top: 11px;
        }
        .body .infos ul li input:focus{
            outline: none;
        }
</style>
</head>
<body>
    <form method="post" enctype="multipart/form-data" id="parent">
    <div class="top">
        <a href="index.php"><i class="back ri-arrow-left-line"></i></a>
        <p>Edit Profile</p>
        <div></div>
        <button id="final-btn" onclick="save()" disabled>Save</button>
    </div>
    <div class="body">
            <div class="infos">
                <ul>
                    <li>
                        <span>Remind Me Where I Left?</span>
                        <select name="remind" onchange="enable_save()" id="remind">
                            <option value="1" <?php if($result['remind']) echo 'selected';?>>Yes</option>
                            <option value="0" <?php if(!$result['remind']) echo 'selected';?>>No</option>
                        </select>
                    </li>
                    <li>
                        <span>Theme</span>
                        <select name="theme" onchange="enable_save()" id="theme">
                            <option value="1" <?php if($result['theme']) echo 'selected';?>>Dark</option>
                            <option value="0" <?php if(!$result['theme']) echo 'selected';?>>Light</option>
                        </select>
                    </li>
                    <li>
                        <span>Recieve Email For LogIn?</span>
                        <select name="" id="">
                            <option value="">Yes</option>
                            <option value="" selected>No</option>
                        </select>
                    </li>
                    <li>
                        <span>Popular Around You?</span>
                        <select name="region" onchange="enable_save()" id="region">
                            <option value="1" <?php if($result['region']) echo 'selected';?>>Yes</option>
                            <option value="0" <?php if(!$result['region']) echo 'selected';?>>No</option>
                        </select>
                    </li>
                    <li>
                        <span>Profile Visibility</span>
                        <select name="" id="">
                            <option value="">Public</option>
                            <option value="">Hidden</option>
                        </select>
                    </li>
                    <li>
                        <span>Share Saved Lists</span>
                        <select name="" id="">
                            <option value="">Yes</option>
                            <option value="">No</option>
                        </select>
                    </li>
                </ul>
            </div>
    </div>
    </form>
    <script>
        let c_remind = <?=$result['remind'];?>;
        let c_theme = <?=$result['theme'];?>;
        let c_region = <?=$result['region'];?>;
        function save()
        {
            document.getElementById("parent").submit();
        }
        function enable_save()
        {
            let remind = document.getElementById("remind").value;
            let theme = document.getElementById("theme").value;
            let region = document.getElementById("region").value;
            if(c_remind == remind && c_theme == theme && c_region == region)
                document.getElementById("final-btn").disabled = true;
            else
                document.getElementById("final-btn").disabled = false;
        }
    </script>
</body>
</html>