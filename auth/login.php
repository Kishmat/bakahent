<?php
include_once "../classes/auth.php";
if(check_login())
{
  header("Location: ../index.php");
  die;
}
$email = "";
$error = false;
$result = "";
$password = "";
$remember = true;
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $result = login($_POST);
    if($result)
    {
      if($result == "success")
      {
        echo "<script>
        localStorage.setItem('user', '". $_SESSION['user']."');
        localStorage.setItem('email', '". $_POST['email']."');
        window.location.replace('../index.php');
        </script>";
      }
      else if($result == "no")
      {
        echo "<script>
        localStorage.setItem('email', '". $_POST['email']."');
        window.location.replace('../index.php');
        </script>";
      }else{
        $error = true;
      }
    }
    $email = $_POST['email'];
    $password = $_POST['pass'];
    if (!isset($_POST['remember']))
        $remember = false;
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
            background-color: #000000bd;
            background-blend-mode: multiply;
        }
        .form{
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
        .form .error{
            font-size: 14px;
            color: #ff7c7c;
            margin: -5px 0;
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
        .form .checkbox{
            display: flex;
            flex-direction: row;
            gap: 8px;
        }
        .form .checkbox input{
            width: 17px;
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
<body onload="check_saved_logins()">
    <form class="form" method="post">
            <h2 class="form-title">Sign In</h2>
            <?php
                if($error)
                {
                    echo "<p class='error'>$result</p>";
                }
            ?>
            <div class="block">
                <span class="label">E-mail</span>
                <input value="<?=$email;?>" id="email" type="email" placeholder="Enter your email address" name="email">
            </div>
            <div class="block">
                <span class="label">Password</span>
                <input value="<?=$password;?>" type="password" placeholder="Enter your password" name="pass">
            </div>
            <div class="block checkbox">
                <input <?php if($remember) echo "checked";?> type="checkbox" name="remember" style="cursor:pointer;">
                <span style="font-size: 14px;">Remember Me</span>
            </div>
            <button class='submit' type="submit">Log In</button>
        <div class="block">
            <p class="other_auth">Don't Have An Account? <a href="signup.php">Sign Up</a></p>
        </div>
        <button type="button" class="end" onclick="location.href = '../index.php';"><i class='bx bx-arrow-back' ></i> Return Home</button>
    </form>
    <form style="display:none;" action="response.php" method="post" id="user-form">
        <input name="id" type="hidden" value="">
        <button type="submit"></button>
      </form>
    <script>
        function check_saved_logins()
        {
            var userid = localStorage.getItem("user"); 
            if(userid == null)
            {
                var email = localStorage.getItem("email"); 
                if(email)
                    document.getElementById('email').value = email;
            }else{
                const form = document.getElementById('user-form');
                form.firstElementChild.value = userid;
                form.lastElementChild.click();
            }
        }
    </script>
</body>
</html>