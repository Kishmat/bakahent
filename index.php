<?php
require_once "classes/connect.php";
require_once "classes/function.php";
require_once "classes/auth.php";
$DB = new Database();
$logged = false;
if(check_login())
{
    $logged = true;
    $user_details = $DB->read("select remind,theme,region from users where userid='$_SESSION[user]' limit 1");
    $user_details = $user_details[0];
}

$query = "select anime_id,img,name,seasons from anime_list order by id desc limit 10";
$result = $DB->read($query);
$popular = get_populars();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BakaHen</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        .wt_wrapper{
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            background: #000000b0;
            width: 100%;
            height: 100%;
            z-index: 11;
        }
        .previous_watch{
            display: none;
            position: fixed;
            bottom: 10px;
            right: 10px;
            background: #1e1e1e;
            z-index: 12;
            padding: 10px 20px;
            border-radius: 8px;
        }
        .previous_watch .info{
            display: flex;
            gap: 5px;
            flex-direction: column;
            width: 250px;
            align-items: center;
            font-size: 14px;
        }
        .previous_watch .info i{
            font-size: 22px;
            position: absolute;
            top: 15px;
            right: 15px;
            cursor: pointer;
            color: #d2d2d2;
        }
        .previous_watch .info .heading{
            margin-bottom: 8px;
        }
        .previous_watch .info .ses{
            display: flex;
            gap: 10px;
        }
        .previous_watch .info button{
            width: 100%;
            padding: 10px 5px;
            border: none;
            border-radius: 8px;
            background: #ff3131;
            color: white;
            cursor: pointer;
            margin-top: 15px;
        }
    </style>


</head>
<body onload="startup()">
    <?php include_once('nav.php');?>
    <!-- Home -->
     <?php if($popular): ?>
     <section class="home swiper" id="home">
        <div class="swiper-wrapper">
            <?php 
                foreach($popular as $cover)
                {
                    $info = get_anime_info($cover['anime_id'],"anime_id,name,studio");
                    echo "<div class='swiper-slide conatiner'>
                        <img src='$cover[cover]'>
                        <div class='home-text'>
                            <span>$info[studio]</span>
                            <h1>$info[name]</h1>
                            <br>
                            <a style='font-size:14px;' href='anime_info.php?id=$info[anime_id]' class='btn'>Learn More</a>
                            <a href='anime_watch.php?id=$info[anime_id]' class='play'>
                                <i class='bx bx-play'></i>
                            </a>
                        </div>
                    </div>";
                }
            ?>
          </div>
          <div class="swiper-pagination"></div>
     </section>

     <?php endif;?>
     <!-- movies -->
      <section class="movies" id="watch">
        <h2 class="heading">Recommended</h2>
        <!-- Movies Container -->
        <div class="movies-container">
            <!-- box 1 -->
             <?php
             if(is_array($result))
             {
               foreach($result as $single)
               {
                echo "<a href='anime_info.php?id=$single[anime_id]'><div class='box'>
                    <div class='box-img'>
                        <img src='$single[img]'>
                    </div>
                    <h3>$single[name]</h3>
                    <span>$single[seasons] Seasons</span>
                </div>
                </a>";
               } 
             }
             ?>
        </div>
      </section>

      <section class="coming" id="popular">
        <h2 class="heading">Popular around you</h2>
        <!-- coming container -->
         <div class="coming-container swiper">
            <div class="swiper-wrapper">
                      <!-- box 1 -->
                <?php
                    if(is_array($result))
                    {
                        foreach($result as $single)
                        {
                            echo "<div style='cursor:pointer;' onclick=","location.href='anime_info.php?id=$single[anime_id]'" , " class='swiper-slide box'>
                                <div class='box-img'>
                                    <img src='$single[img]' alt=''>
                                </div>
                                <h3>$single[name]</h3>
                                <span>$single[seasons] Seasons</span>
                                </div>";
                        } 
                    }
                ?>
            </div>
         </div>
      </section>

      <section class="footer">
        <a href="" class="logo">
            <i class='bx bxs-coffee-bean'></i> BakaHen
        </a> 
      </section>

      <div class="copyright">
        <p>&#169; BakaHen All Rights Reserved.</p>
      </div>
    
      <div class="wt_wrapper" onclick="close_prev(true,this)"></div>
      <div class="previous_watch">
        <div class="info">
            <div class="heading">You left on : </div><i class='bx bx-x' onclick="close_prev(false,this)"></i>
            <img style="width:100%;height:250px;object-fit:contain;" src="">
            <div class="name"></div>
            <div class="ses">
                <p>Season : <span class="s"></span></p>
                <p>Episode : <span class="ep"></span></p>
            </div>
            <button type="button" data-id="0" data-ep="0" data-ses="0" onclick="watch(this)">Continue To Watch</button>
        </div>
      </div>

     <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
     <script src="script.js"></script>
     <script src="swiper.js"></script>

     <script>
        function startup()
        {
            <?php if($logged && $user_details['remind'] == '0'): ?>
                return;
            <?php else: ?>
                if(sessionStorage.getItem("temp") == "true")
                    return;
                sessionStorage.setItem("temp",true);
                let test = localStorage.getItem("prevSes");
                if(!test)
                    return;
                test = JSON.parse(test);

                let ele = document.querySelector(".previous_watch");
                let info = ele.firstElementChild;
                info.querySelector("img").src = "anime/"+test.anime_id+".jpg";
                info.querySelector(".name").textContent = test.name;
                if(test.ses < 0)
                {
                    info.querySelector(".s").parentElement.textContent = "Movie : "+(test.ses*-1);
                    info.querySelector(".ep").parentElement.style.display = "none";
                }else{
                    info.querySelector(".s").textContent = test.ses;                
                }
                info.querySelector(".ep").textContent = test.ep;

                info.lastElementChild.dataset.id = test.anime_id;
                info.lastElementChild.dataset.ep = test.ep;
                info.lastElementChild.dataset.ses = test.ses;
                

                ele.style.display = "block";
                ele.previousElementSibling.style.display = "block";
            <?php endif; ?>
        }

        function close_prev(state,ele){
            if(state)
            {
                ele.style.display = "none";
                ele.nextElementSibling.style.display = "none";
            }else{
                let test = ele.parentElement.parentElement;
                test.style.display = "none";
                test.previousElementSibling.style.display = "none";
            }
        }

        function watch(e)
        {
            if(e.dataset.ses < 0)
                location.href = "anime_watch.php?id="+e.dataset.id+"&f="+(e.dataset.ses*-1);
            else
                location.href = "anime_watch.php?id="+e.dataset.id+"&s="+e.dataset.ses+"&ep="+e.dataset.ep;
        }
     </script>
</body>
</html>
