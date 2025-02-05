<?php
include_once "../classes/auth.php";
if(check_login())
{
  header("Location: ../index.php");
  die;
}
$fname = '';
$lname = '';
$email = '';
$pass = '';
$cpass = '';
$err = 0;
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $_POST['fname'] = ucfirst(strtolower($_POST['fname']));
    $_POST['lname'] = ucfirst(strtolower($_POST['lname']));
    $_POST['email'] = strtolower($_POST['email']);
    if($_POST['pass'] == $_POST['pass2'])
    {
      $err = signup($_POST);
    }else{
      $err = 3;
    }
    if($err == 0)
    {
        header("Location: login.php");
        die;
    }
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $pass = $_POST['pass'];
  $cpass = $_POST['pass2'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BakaHen</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="../style.css">
    <style>
        body{
            width: 100%;
            height:100vh;

            background: url("../img/bg.jpg");
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            background-color: #000c;
            background-blend-mode: multiply;
        }
        .form{
            height: 91vh;
            overflow-y: scroll;
            scrollbar-width: none;

            display: flex;
            padding: 5px 15px;
            width: 100%;
            max-width: 370px;
            flex-direction: column;
            gap: 15px;
            align-items: center;

            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
        }
        .form .block{
            display: flex;
            flex-direction: column;
            gap: 5px;
            width: 100%;
        }
        .form .block .label{
            font-size: 14px;
            color: #cfcfcf;
        }
        .form .block input{
            outline: none;
            background: transparent;
            color: white;
            border: 1px solid #d4d4d4b2;
            padding: 10px 15px;
            border-radius: 5px;
        }
        .form .err input{
            border: 1px solid #ff7c7c;
        }
        .form .block .error{
            font-size: 13px;
            color: #ff7c7c;
            margin-left: 5px;
        }
        .form .submit{
            border: none;
            padding: 12px 10px;
            width: 200px;
            margin: 15px 0;
            border-radius: 12px;
            cursor: pointer;
            color: white;
            background: #c83c3c;
        }
        .form .block .other_auth{
            margin-top: 10px;
            color: #e2e2e2;
            font-size: 15px;
            text-align: center;
        }
        .form .block .other_auth a{
            color: #f68282;
            font-size: 16px;
        }
        .form .end{
            border: none;
            padding: 10px;
            width: 200px;
            border-radius: 12px;
            cursor: pointer;
            color: white;
            background: #2f3866;
            margin-top: 30px;

            display: flex;
            gap: 5px;
            justify-content: center;
            align-items: center;
        }
        .form .end i{
            font-size: 18px;
        }
    </style>
</head>
<body>
    <form class="form" method="post">
            <h2 class="form-title">Sign Up</h2>
            <div class="block" id="fname">
                <span class="label">First Name</span>
                <input value="<?=$fname;?>" type="text" placeholder="Enter your First Name" name="fname">
                <?php if($err == 1):?>
                    <p class="error">First name either has numbers or spaces!</p>
                <?php endif;?>
            </div>
            <div class="block" id="lname">
                <span class="label">Last Name</span>
                <input value="<?=$lname;?>" type="text" placeholder="Enter your Last Name" name="lname">
                <?php if($err == 2):?>
                    <p class="error">Last name either has numbers or spaces!</p>
                <?php endif;?>
            </div>
            <div class="block" id="email">
                <span class="label">E-mail</span>
                <input value="<?=$email;?>" type="email" placeholder="Enter your email address" name="email">
                <?php if($err == 4):?>
                    <p class="error">Email already exists!</p>
                <?php endif;?>
            </div>
            <div class="block">
                <span class="label">Password</span>
                <input type="password" value="<?=$pass;?>" placeholder="Enter your password" name="pass">
            </div>
            <div class="block" id="pass">
                <span class="label">Confirm Password</span>
                <input type="password" value="<?=$cpass;?>" placeholder="Re-enter your password" name="pass2">
                <?php if($err == 3):?>
                    <p class="error">Passwords donot match!</p>
                <?php endif;?>
            </div>
            <button class='submit' type="submit">Sign Up</button>
        <div class="block">
            <p class="other_auth">Already Have An Account? <a href="login.php">Sign In</a></p>
        </div>
        <button type="button" class="end" onclick="location.href = '../index.php';"><i class='bx bx-arrow-back' ></i> Return Home</button>
    </form>
    <script>
        let err = <?=$err?>;
        if(err == 1)
        {
            document.getElementById("fname").classList.add("err");
        }else if(err == 2)
        {
            document.getElementById("lname").classList.add("err");
        }
        else if(err == 3)
        {
            document.getElementById("pass").classList.add("err");
        }
        else if(err == 4)
        {
            document.getElementById("email").classList.add("err");
        }
    </script>
</body>
</html>