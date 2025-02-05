<?php
session_start();
if(!isset($_SESSION['user']))
{
    header("Location: index.php");
    die;
}
include_once "classes/function.php";
$mydata = get_profile($_SESSION['user']);
$myprofile_pic = get_profile_pic($_SESSION['user']);


$cache_fname = "";
$cache_lname = "";
$test = "";
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $cache_fname = $_POST['fname'];
    $cache_lname = $_POST['lname'];
    $test = make_profile_changes($_POST, $_FILES, $mydata);

    if($test == "success"){
        header("Location: profile.php");
        die;
    }

    if($test != 101 && $test != 102 && $test != "success" && $test != "")
    {
        echo "An error occured!";
        die;
    }
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
    img{
        cursor: pointer;
    }
    body{
        background: var(--color-background-2);
        height: calc(100vh - 70px);
    }
    .click_prohibit{
        position: fixed;
        display: none;
        width: 100%;
        height: 100%;
        z-index: 18;
        color: white;
        top: 0;
        background-color: rgba(40, 40, 40, 0.83);
        left: 0;
    }
    .click_prohibit p{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
    }
    .click_prohibit .spinner{
        width: 15px;
        height: 15px;
        border: 3px solid white;
        border-radius: 50%;
        border-top-color: #aeaeae;
        position: absolute;
        top: calc(50% - 10px);
        left: calc(50% - 63px);
        translate: -50%;
        animation: 1s infinite;
    }
    @keyframes spin{
        from{transform:rotate(0deg);}
        to{transform:rotate(360deg);}
    }
    .preview{
        display: none;
        position: fixed;
        z-index: 17;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: rgb(36, 36, 36);
        padding: 15px 20px;border-radius: 10px;
    }
    .preview p{
        color: white;
        font-size: 21px;
        text-align: center;
        margin-bottom: 15px;
    }
    .preview .image_container{
        display: block;
        margin-bottom: 15px;
        margin-right: auto;
        margin-left: auto;
        width: 300px;
    }
    .preview .act{
        text-align: right;
    }
    .preview .act button{
        border: none;
        cursor: pointer;
        padding: 7px 17px;
        border-radius: 7px;
        background: #353535;
        color: white;
        font-size: 15px;
    }
    .preview .act .save{
        background: #2d59ae;
        margin-left: 10px;
    }
    .preview .act .save:hover{
        border: 1px solid #2d59ae;
        background: transparent;
    }
    .preview .act .cancel:hover{
        border: 1px solid #353535;
        background: transparent;
    }
    .preview_wrapper{
        width: 100%;
        display: none;
        height: 100%;
        z-index: 16;
        position: absolute;
        top: 0;
        left: 0;
        background: #2b2b2bbf;
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
    .body .images{
        margin-top: 60px;
        padding: 15px;
        width: 90%;
        margin-left: auto;
        margin-right: auto;
        border-radius: 12px;
    }
    .body .images .profile{
        position: relative;
    }
    .body .images .profile p{
        text-align: center;
        color: white;
        font-size: 17px;
    }
    .body .images .profile img{
        width: 120px;
        margin-top: 15px;
        border-radius: 50%;
        opacity: 0.7;
    }
    .body .images .ahuhu{
        width: fit-content;
        margin-left: auto;
        margin-bottom: 10px;
        margin-right:auto;
    }
    .body .images .profile span{
        position: absolute;
        font-size: 28px;
        color: transparent;
        left: calc(50% - 15px);
        top:  calc(50% - 6px);
        cursor: pointer;
    }
    .body .images .ahuhu:hover span{
        color:#d0d0d0;
    }
    .body .images .ahuhu:hover img{
        opacity: 0.4;
    }
    .body .infos ul li{ 
        color: white;
        padding: 15px;
        margin-bottom: 15px;
        margin-top: 15px;
        position: relative;
        border-radius: 9px;
        width: 80%;
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
        .body .infos ul li input:focus{
            outline: none;
        }
        .profile_preview{
            margin: 10px 0px;
            border-radius: 8px;
            width: 350px;
            height: 350px;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
        #logout{
            color: #ff5252;
            display: block;
            width: fit-content;
            margin: 0 auto;
            margin-top: 40px;
            border: 1px solid;
            padding: 7px 20px;
            border-radius: 10px;
        }
</style>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
    <div class="top">
        <a href="index.php"><i class="back ri-arrow-left-line"></i></a>
        <p>Edit Profile</p>
        <div></div>
        <button id="final-btn" disabled>Save</button>
    </div>
    <div class="body">
        <div class="images">
            <div class="profile">
                <p>Profile Picture</p>
            <div class="ahuhu">
            <label for="profile_input">
                <img id="profile_img" src="<?=$myprofile_pic?>" alt="">
                <span><i class="ri-upload-cloud-fill"></i></span>
            </label>
            <input onchange="preview(this);enable_save()" type="file" accept="image/png, image/jpeg" name="profile_img" id="profile_input" hidden="true">
            </div>
            </div>
            </div>
            <div class="infos">
                <ul>
                    <li>
                        <span>First Name</span>
                        <?php
                            $fdata = ($cache_fname == "") ? $mydata['fname'] : $cache_fname;
                            $ldata = ($cache_lname == "") ? $mydata['lname'] : $cache_lname;
                        ?>
                        <input oninput='enable_save()' name="fname" id="fname" type="text" value="<?=$fdata?>" required>
                    </li>
                    <?php
                    if($test == 101)
                        echo "<p style='color: #ff7c7c;text-align: right;margin: -10px 40px -10px 0px;'>First Name either has numbers or spaces!</p>";
                    ?>
                    <li>
                        <span>Second Name</span>
                        <input oninput='enable_save()' name="lname" id="lname" type="text" value="<?=$ldata?>" required>
                    </li>
                    <?php
                    if($test == 102)
                        echo "<p style='color: #ff7c7c;text-align: right;margin: -10px 40px -10px 0px;'>Last Name either has numbers or spaces!</p>";
                    ?>
                    <li>
                        <span>Email</span>
                        <input style="color:gray;font-style:italic;" type="email" value="<?=$mydata['email']?>" disabled>
                    </li>
                    <a id="logout" href="logout.php">Log Out</a>
                </ul>
            </div>
    </div>
    </form>

    <div class="preview_wrapper" onclick="close_preview();"></div>
    <div class="preview">
        <p>Preview</p>
        <div id="image_container"></div>
        <div class="act">
            <button class="cancel" onclick="close_preview()">Cancel</button>
            <button class="save" onclick="final()">Save</button>
        </div>
    </div>
    <div class="click_prohibit">
        <div class="spinner"></div>
        <p>Please Wait</p>
    </div>
    <script>
        var fname = "<?=$mydata['fname']?>";
        var lname = "<?=$mydata['lname']?>";
        document.getElementById("final-btn").disabled = true;

    function close_preview()
    {
        document.querySelector(".preview").style.display = "none";
        document.querySelector(".preview_wrapper").style.display = "none";
        document.body.style.overflowY = "auto";
        document.getElementById("profile_input").value = "";
    }
    
    function preview(e)
    {  
        var ext = e.files[0].name.split('.').pop().toLowerCase();
        if(ext == "jpeg" || ext == "png" || ext == "jpg")
        {
            var container = document.getElementById("image_container");
            container.innerHTML = "";
            let reader = new FileReader();
            let figure =document.createElement("figure");
            reader.onload = ()=>{
                let div =document.createElement("div");
                if(e.id == "profile_input")
                {
                    div.className = "profile_preview";
                }
                div.setAttribute("style","background-image:url('"+reader.result+"');");
                figure.appendChild(div);
            }
            container.appendChild(figure);
            reader.readAsDataURL(e.files[0]);
        }else{
            alert("Invalid file format. Accepted ones are JPG and PNG.");
            location.reload();
        }
        document.body.style.overflowY = "hidden";
        document.querySelector(".preview").style.display = "block";
        document.querySelector(".preview_wrapper").style.display = "block";
    }
    function final()
    {
        document.querySelector(".preview").style.display = "none";   
        document.querySelector(".preview_wrapper").style.display = "none";
        document.querySelector(".click_prohibit").firstElementChild.setAttribute("style", "animation-name:spin;");
        document.querySelector('.click_prohibit').style.display = "block";
        document.getElementById("final-btn").disabled = false;
        document.getElementById("final-btn").click(); 
        document.getElementById("final-btn").disabled = true;
    }
    function enable_save()
    {
        var nfname =document.getElementById("fname").value.trim();
        var nlname =document.getElementById("lname").value.trim();
        if(nfname == fname && nlname == lname)
        {
            document.getElementById("final-btn").disabled = true;
        }else{
            if(nfname != '' && nlname != '')
                document.getElementById("final-btn").disabled = false;
            else
                document.getElementById("final-btn").disabled = true;
        }
    }
    </script>
</body>
</html>