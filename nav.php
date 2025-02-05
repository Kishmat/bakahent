<?php
require_once 'classes/auth.php';
require_once 'classes/function.php';
$DB = new Database();
$logged = false;
if(check_login())
{
    $logged = true;
    $user = $DB->read("select fname from users where userid='$_SESSION[user]' limit 1");
    $user = $user[0];
    $profile_pic = get_profile_pic($_SESSION['user']);
}
$active = 0;
if($_SERVER['SCRIPT_NAME'] == '/bakahen/index.php')
    $active = 1;
else if($_SERVER['SCRIPT_NAME'] == '/bakahen/discover.php')
    $active = 2;
else if($_SERVER['SCRIPT_NAME'] == '/bakahen/search.php')
    $active = 3;

?>
<header>
    <a href="index.php" class="logo">
        <i class='bx bxs-coffee-bean'></i> BakaHent
    </a>
    <div class="bx bx-menu" id="menu-icon">
    </div>

    <!-- menubar -->
    <ul class="navbar">
        <li><a href="index.php#home" class="<?php if($active == 1)echo 'active';?>">Home</a></li>
        <li><a href="discover.php" class="<?php if($active == 2)echo 'active';?>">Discover</a></li>
        <li><a href="search.php" class="<?php if($active == 3)echo 'active';?>">Search</a></li>
    </ul>
    <?php if($logged): ?>
    <div style="position:relative;">
        <div class='user_logo' onclick="show_profile_menu()">
            <img style='width: 30px;border-radius: 50%;' src="<?=$profile_pic?>">
            <?=$user['fname'];?>
        </div>
        <div class="prof_wrapper" onclick="close_profile_menu()"></div>
        <div class="profile_options">
            <i class='bx bx-x close' onclick="close_profile_menu()"></i>
            <a href="profile.php" class="item"><i class='bx bxs-edit'></i><span>Edit Profile</span></a>
            <a href="settings.php" class="item"><i class='bx bx-slider-alt'></i><span>User Preferences</span></a>
            <?php if($_SESSION['user'] == 645):?>
            <a href="admin/admin.php" class="item"><i class='bx bx-user'></i><span>Admin</span></a>
            <?php endif;?>
            <a class="item"><i class='bx bxs-bookmark'></i><span>View Saved</span></a>
            <a class="item"><i class='bx bx-rupee'></i><span>Donate</span></a>
            <a href="logout.php" class="item special"><i class='bx bx-log-out'></i><span>Log Out</span></a>
        </div>

    </div>
    <?php else:?>
    <a href="auth/login.php" class="btn">Sign In</a>
    <?php endif; ?>
    <?php if($logged): ?>

    <script>
        function show_profile_menu(){
            document.querySelector(".profile_options").style.display = "flex";
            document.querySelector(".prof_wrapper").style.display = "block";
            document.body.style.overflowY = "hidden";
        }
        function close_profile_menu()
        {
            document.querySelector(".profile_options").style.display = "none";
            document.querySelector(".prof_wrapper").style.display = "none";
            document.body.style.overflowY = "scroll";
        }
    </script>
    <?php endif; ?>
</header>