<?php
if(!isset($_GET['id']))
{
    header("Location:index.php");
    die;
}else{
    $id = $_GET['id'];
}
require_once "classes/connect.php";
$DB = new Database();
$query = "select * from anime_list where anime_id='$id' limit 1";
$result = $DB->read($query);
if(!is_array($result))
{
    echo "No result found";
    die;
}
$anime = $result[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <title>Anime Info</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .main{
            display: flex;
            gap: 25px;
            margin-top: 120px;
            padding: 0 25px;
            max-width: 968px;
            margin-left: auto;
            margin-right: auto;
        }
        .main .left{
            display: flex;
            flex-direction: column;
            gap: 25px;
            align-items: center;
        }
        .main .left img{
            width: 250px;
        }
        .main .content{
            display: flex;
            flex-direction: column;
            gap: 25px;
        }
        .main .content .jp{
            color: #b9b9b9;
            margin-top: 5px;
            font-size: 16px;
            font-weight: 600;
        }
        .main .content .about{
            font-size: 15px;
            text-align: justify;
        }
        .main .left ul{
            display: flex;
            flex-direction: column;
            gap: 5px;
            justify-content: space-around;
            max-width: 250px;
        }
        .main .left ul .info{
            display: flex;
            gap: 25px;
            justify-content: center;
            align-items: center;
        }
        .main .left ul .info p{
            width: 50%;
            font-size: 15px;
        }
        .main .left ul .info .info_head{
            width: 50%;
            font-weight: 600;
        }

        .main .content .seasons{
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }
        .main .content .seasons .season
        {
            width: 120px;
            cursor: pointer;
            text-align: center;
            padding: 10px;
            border-radius: 8px;
            background: #2c2e2f;
        }
        .main .content .seasons .season:hover
        {
            background: var(--main-color);
        }
        @media(max-width:774px)
        {
            .main{
                flex-direction: column;
            }
        }
        @media(max-width:472px)
        {
            .main{
                padding: 0 15px;
            }
        }
    </style>
</head>
<body>
    <?php include_once('nav.php');?>
    <div class="main">
        <div class="left">
            <img src="<?=$anime['img'];?>">
            <ul class="info_lists">
                <li class="info"><p class="info_head">Status : </p> <p><?=$anime['status'];?></p></li>
                <li class="info"><p class="info_head">Seasons : </p> <p><?=$anime['seasons'];?></p></li>
                <li class="info"><p class="info_head">Studio : </p> <p><?=$anime['studio'];?></p></li>
                <li class="info"><p class="info_head">Themes : </p> <p><?=$anime['theme'];?></p></li>
            </ul>
        </div>
        <div class="content">
            <div class="title">
                <h2 class="en"><?=$anime['name'];?></h2>
                <h3 class="jp"><?=$anime['jp_name'];?></h3>
            </div>
            <div class="about">
            <?=$anime['summary'];?>
            </div>
            <!-- Episodes -->
             <br>
             <div class="heading">Watch Now</div>
             <div class="seasons">
                <!-- box1 -->
                
                    <?php
                        $actual = $DB->read("select season from season where anime_id='$anime[anime_id]'");
                        if(is_array($actual))
                        {
                            foreach($actual as $season)
                            {
                                if($season['season'] > 0)
                                    echo "<a href='anime_watch.php?id=$anime[anime_id]&s=$season[season]'><div class='season'>Season $season[season]</div></a>";
                                else
                                {
                                    $film = $season['season']*-1;
                                    echo "<a href='anime_watch.php?id=$anime[anime_id]&f=$film'>
                                    <div class='season'>Movie $film</div></a>";
                                }
                            }
                        }
                    ?>
             </div>
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
</body>
</html>