<?php
ob_start();
$season = 1;
$ep = 1;
if(!isset($_GET['id']))
{
    header("Location:index.php");
    die;
}else{
    if(isset($_GET['s']))
    {
        $season = $_GET['s'];
        if($season <= 0)
            $season = 1;
    }
    else if(isset($_GET['f']))
    {
        $season = $_GET['f']*-1;
    }
    if(isset($_GET['ep']))
    {
        $ep = $_GET['ep'];
        if($ep <= 0)
            $ep = 1;
    }
    $id = $_GET['id'];
}
require_once "classes/connect.php";
require_once "classes/function.php";
$DB = new Database();
$query = "select name,seasons,adult from anime_list where anime_id='$id' limit 1";
$anime_info = $DB->read($query);
if(!is_array($anime_info))
{
    echo "No result found";
    die;
}
$anime_info = $anime_info[0];

$next_ep = false;
$prev_ep = false;

$curr_season = $DB->read("select * from season where anime_id='$id' && season='$season' limit 1");

if(is_array($curr_season))
{
    $curr_season = $curr_season[0];
    if($ep < $curr_season['aired_ep'])
        $next_ep = true;
    if($ep > 1 && $ep <= $curr_season['aired_ep'])
        $prev_ep = true;
}else{
    echo "No Such Episode Found";
    die;
}
if($ep > $curr_season['aired_ep'])
{
    echo "No Such Episode Found";
    die;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <title>Anime Watch</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .main{
            display: flex;
            flex-direction: column;
            gap: 25px;
            margin-top: 120px;
            padding: 0 25px;
            max-width: 968px;
            margin-left: auto;
            margin-right: auto;
        }

        .main #video{
            margin-left: -4px;
            border: none;
            overflow: hidden;
        }
        .main .video-info{
            display: flex;
            flex-direction: column;
            gap: 10px;
            font-size: 15px;
        }
        .main .video-info .info{
            display: flex;
            gap: 5px;
            flex-direction: column;
        }
        .main .action{
            display: flex;
        }
        .main .action button{
            border: none;
            cursor: pointer;
            padding: 5px 0;
            padding-right: 15px;
            border-radius: 5px;
            background: #232323;
            color: white;
            width: 120px;
            display: flex;
            align-items: center;
        }
        .main .action button i{
            font-size: 22px;
            margin-left: 10px;
        }
        .main .action button.next i{
            margin-left: 0;
            margin-right: 10px;
        }
        .main .action button.next{
            margin-left: auto;
            padding-right: 0;
            padding-left: 15px;
            background: #ad2b23;
        }
        .main .episodes{
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;

            max-height: 230px;
            overflow-y: scroll;
            scrollbar-width: none;
        }
        .main .episodes .ep{
            width: 65px;
            cursor: pointer;
            text-align: center;
            padding: 8px;
            border-radius: 5px;
            background: #232323;
        }
        .main .episodes .ep.active ,.main .episodes .ep:hover{
            background: var(--main-color);
        }
        @media(max-width:472px)
        {
            .main{
                padding: 0 7px;
            }
        }
        #wait{
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        #wait .loader{
            border: 4px solid #6e6e6e;
            border-top: 4px solid rgb(255, 255, 255);
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 2s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .main .player{
            position: relative;
        }
        .main .player .border{
            display: none;
            border: 1px solid #888;
            height: calc(100% - 4px);
            width: calc(100% - 6px);
            position: absolute;
            top: 6px;
            left: 3px;
            z-index: -1;
        }
        /* .main .player i{
            display: none;
            position: absolute;
            cursor: pointer;
            border-radius: 3px;
            z-index: 9;
            color: white;
            background: black;

            bottom: 11px;
            right: 10px;
            font-size: 21px;
            padding: 6px;
        }
        .main .player i.bx-exit-fullscreen{
            bottom: 10px;
            right: 10px !important;
        }
        .main .player i:hover{
            background: #00b3ff;
        } */
        @media(max-width:479px)
        {
            .main .player i.bx-exit-fullscreen{
                bottom: 5px;
                right: 5px !important;
            }
        }
        @media(max-width:531px)
        {
            .main .player i{
                bottom: 6px;
                right: 5px;
            }
        }

        .main .video-info .ep_action{
            display: none;
            margin-top: -10px;
            margin-bottom: 5px;
        }
        .main .video-info .ep_action > *{
            display: flex;
            gap: 5px;
            margin-left: auto;
            align-items: center;
            cursor: pointer;
            color: #fff;
            background: #ff2f2f;
            padding: 6px 20px;
            border-radius: 5px;
        }
        .main .video-info .ep_action .prev{
            background: #2e2e2e;
            margin-left: 0;
        }
        .adult_wrapper{
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #000000f0;
            z-index: 49;
        }
        .adult_alert{
            width: 96%;
            max-width: 390px;
            position: fixed;
            top: 50%;
            left: 50%;
            background: #070707;
            z-index: 50;
            transform: translate(-50%,-50%);
            padding: 25px;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            gap: 15px;
            border: 1px solid #a86d00;
        }
        .adult_alert .title{
            border-bottom: 1px solid orange;
            font-size: 17px;
            width: fit-content;
            margin: 0 auto;
            text-transform: uppercase;
            margin-bottom: 10px;
            font-weight: 600;
        }
        .adult_alert .description{
            color: #d8d8d8;
            font-size: 15px;
            text-align: center;
        }
        .adult_alert button{
            margin-top: 20px;
            border: none;
            padding: 13px 0;
            border-radius: 4px;
            background: orange;
            color: black;
            cursor: pointer;
        }
        .adult_alert button.return{
            margin-top: 0px;
            background: #272727;
            color: white;
        }

    </style>
</head>
<body onload="startup()">
    <?php include_once('nav.php');?>
    <?php if($anime_info['adult']):?>
        <div class="adult_wrapper"></div>
        <div class="adult_alert">
            <h5 class="title" style="margin-bottom:10px;">Warning : Sensitive Content</h5>
            <p class="description">The content you are trying to view was found to contain Sensitive Content which may include (Nudity, Violence, Profanity, Porn)
                 that some people may find offensive.<br>Noone under 18 years of age is allowed to continue. If you got here by mistake, you may choose to return back or if you are eligible you may proceed!<br><br>Note that the site will not be loading any further unless a decision has been made!</p>
            <button onclick="hide()">I Am 18+ And Wish To Enter</button>
            <button onclick="location.href='index.php';" class="return">Return To Home</button>
        </div>

        <script>
            let allow = true;
            {
                let adult = sessionStorage.getItem("adult_alert");
                if(adult)
                {
                    if(parseInt(adult) == <?=$id?>)
                    {
                        document.querySelector(".adult_wrapper").style.display = "none";
                        document.querySelector(".adult_alert").style.display = "none";
                        allow = false;
                    }
                }
            }
        </script>
    <?php endif;?>
    <div class="main">
            <div id="wait">
                <div class="loader"></div>
                <span>Getting Your Video</span>
            </div>
            <div class="player">
                <iframe style="display:none;" id="video" width="100%" height="100%" 
                src="https://gogoanime.org.es/streaming.php?slug=<?php echo "$curr_season[id_name]-episode-$ep";?>" scrolling="no" frameborder=""
                sandbox="allow-scripts allow-same-origin" allowfullscreen></iframe>
                <div class="border"></div>
                <!-- MANUAL FULLSCREEN -->
                    <!-- <i class='bx bx-fullscreen' onclick="toggle_fullscreen(this)" id="full_btn"></i> -->
                <!-- MANUAL FULLSCREEN -->
            </div>

            <!-- <iframe style="display:none;" id="video" width="100%" height="100%" src="https://player.anitaku.xyz/?id=<?php echo "$curr_season[id_name]-episode-$ep";?>" scrolling="no" frameborder=""
            sandbox="allow-scripts" allowfullscreen></iframe>-->
        <div class="video-info">

            <div class="ep_action">
                <?php if($prev_ep):?>
                    <div class="prev" onclick="episode(-1)"><i class='bx bx-left-arrow-alt'></i> Previous</div>
                <?php endif;?>
                <?php if($next_ep):?>
                    <div class="next" onclick="episode(1)">Next <i class='bx bx-right-arrow-alt'></i></div>
                <?php endif;?>
            </div>

            <p>Your are watching : </p>
            <h4 class="name"><?=$anime_info['name'];?></h4>
            <div class="info">
                <div class="season">Name : <span><?=$curr_season['season_name'];?></span></div>
                <?php if(isset($_GET['s'])): ?>
                    <div class="season">Season : <span><?=$curr_season['season'];?></span></div>
                <?php elseif(isset($_GET['f'])): ?>
                    <div class="season">Movie : <span><? echo ($curr_season['season']*-1);?></span></div>
                <?php endif; ?>
                <div class="episode">Episode : <span><?=$ep;?></div>
            </div>
        </div>
        <div class="episodes">
            <?php
                $eps = $curr_season['aired_ep'];
                for ($i=1; $i <= $eps; $i++) {
                    if($i == $ep)
                        echo "<div onclick='change_ep($i,this)' class='ep active' id='ep_active'>$i</div>";
                    else
                        echo "<div onclick='change_ep($i,this)' class='ep'>$i</div>";
                }
            ?>
        </div>
        <div class="action">
            <?php if(allowed_prev_ses($id,$season)): ?>
                <button onclick="season(-1)" class="prev"><i class='bx bx-left-arrow-alt'></i> Previous Season</button>
            <?php endif; ?>
            <?php if(allowed_next_ses($id,$season)): ?>
                <button onclick="season(1)" class="next">Next Season <i class='bx bx-right-arrow-alt'></i></button>
            <?php endif; ?>
        </div>
    </div> 
    <section class="footer">
        <a href="" class="logo">
            <i class='bx bxs-coffee-bean'></i> BakaHen
        </a>
      </section>

      <div class="copyright">
        <p>&#169; BakaHen All Rights Reserved.</p>
      </div>

    <script src="script.js"></script>
    <script>
        <?php if($anime_info['adult']):?>
            if(allow)
                document.body.style.overflowY = 'hidden';
        <?php endif;?>
            //MANUAL FULLSCREEN
                //let fullscreened = false;
                //let button = document.getElementById("full_btn");
            //MANUAL FULLSCREEN

            var client_width = 0;
            // Adjusting the iframe height onload event
            var iframe = document.getElementById("video");
            //let test = iframe.parentElement;

            let ep_active = document.getElementById("ep_active");
            ep_active.scrollIntoView({ block: "end" });


            
            window.onresize = () => {
                resize_video();
            };
            iframe.onload = ()=>{
                iframe.style.display = "block";
                iframe.nextElementSibling.style.display = "block";
                document.getElementById("wait").style.display = "none";
                iframe.style.height = Math.floor(iframe.clientWidth/1.77) + "px";
                document.querySelector(".ep_action").style.display = "flex";

            //MANUAL FULLSCREEN
                // document.body.addEventListener("keypress", (ev)=>{
                //     if(ev.keyCode == 102 && !fullscreened)
                //     {
                //         test.requestFullscreen();
                //     }
                // });
            //MANUAL FULLSCREEN
            };
            function resize_video()
            {
                if(client_width == iframe.clientWidth)
                    return;
                iframe.style.height = Math.floor(iframe.clientWidth/1.77) + "px";
                client_width = iframe.clientWidth;
            }


        function change_ep(index,ele)
        {
            let ep = <?=$ep?>;
            if(index == ep || <?=$season?> < 0)
                return;
            location.href = "anime_watch.php?id=<?=$id?>&s=<?=$season?>&ep="+index;
        }
        function season(n)
        {
            var ajax = new XMLHttpRequest();
            var data = {};
            data.anime_id = <?=$id?>;
            data.perform = n;
            data.current = <?=$season?>;
            data.action = "get_season";
            data = JSON.stringify(data);
            ajax.addEventListener("readystatechange",()=>{
                if(ajax.readyState == 4 && ajax.status == 200)
                {
                    if(ajax.responseText > 0)
                        location.href = "anime_watch.php?id=<?=$id?>&s="+ajax.responseText;
                    else{
                        let num = ajax.responseText*-1;
                        location.href = "anime_watch.php?id=<?=$id?>&f="+num;
                    }
                }
            });
            ajax.open("POST",'ajax/ajax.php',true);
            ajax.send(data);
            return;
        }


        //player
        //MANUAL FULLSCREEN
            // test.onfullscreenchange = fullscreen_changed;
            // function toggle_fullscreen (e)
            // {
            //     if(e.className == "bx bx-fullscreen")
            //     {
            //         test.requestFullscreen();
            //     }else{
            //         document.exitFullscreen();
            //     }
            // }

            // function fullscreen_changed()
            // {
            //     if(document.fullscreenElement)
            //     {
            //         fullscreened = true;
            //         button.className = "bx bx-exit-fullscreen";
            //         iframe.style.height = "100%";
            //         iframe.style.border = "none";
            //     }else{
            //         fullscreened = false;
            //         button.className = "bx bx-fullscreen";
            //         resize_video();
            //         iframe.style.border = "";
            //     }
            // }
        //MANUAL FULLSCREEN
        function episode(n)
        {
            var ses = <?=$season?>;
            var ep = <?=$ep?>+n;
            location.href = "anime_watch.php?id=<?=$id?>&s="+ses+"&ep="+ep;
        }
        function hide()
        {
            document.querySelector(".adult_alert").style.display = "none";
            document.querySelector(".adult_wrapper").style.display = "none";
            document.body.style.overflowY = 'auto';
            sessionStorage.setItem("adult_alert","<?=$id?>");
        }
        function startup()
        {
            let anime_id = "<?=$id?>";
            let ep = <?=$ep?>;
            let ses = <?=$season?>;
            let test = localStorage.getItem("prevSes");

            <?php if($anime_info['adult']):?>
               let adult = sessionStorage.getItem("adult_alert");
               if(adult)
               {
                    if(adult != parseInt(anime_id))
                    {
                        sessionStorage.setItem("adult_alert",anime_id);
                    }
                }
            <?php endif; ?>


            if(test)
            {
                test = JSON.parse(test);

                if(test.anime_id == parseInt(anime_id) && test.ep == ep && test.ses == ses)
                {
                    return;
                }else{
                    var data = {};
                    data.ses = ses;
                    data.ep = ep;
                    data.anime_id = anime_id;
                    data.name = "<?=$curr_season['season_name']?>";
                    data = JSON.stringify(data);
                    localStorage.setItem("prevSes", data);
                }
            }else{
                var data = {};
                data.ses = ses;
                data.ep = ep;
                data.anime_id = anime_id;
                data.name = "<?=$curr_season['season_name']?>";
                data = JSON.stringify(data);
                localStorage.setItem("prevSes", data);
            }
        }
    </script>
</body>
</html>