<?php
require_once "classes/connect.php";
require_once "classes/function.php";
$search='';
$result = '';
if(isset($_GET['s']))
{
    $search = addslashes($_GET['s']);
    $result = get_search_results($search);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BakaHen</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .search_wrapper{
            padding: 10px 15px;
        }
        .search_wrapper .input{
            position: relative;
            display: flex;
            margin: auto;
            width: 100%;
            max-width: 560px;
            padding: 10px 15px;
            align-items: center;
            justify-content: center;
            color: black;
        }
        .search_wrapper .input input{
            width: 100%;
            border: none;
            padding: 10px 40px 10px 35px;
            border-radius: 5px;
            outline: none !important;
        }
        .search_wrapper .input #icon{
            position: absolute;
            top: 20px;
            left: 23px;
            font-size: 20px;
            color: #8a8a8a;
        }
        .search_wrapper .input #clear{
            position: absolute;
            top: 19px;
            right: 25px;
            font-size: 23px;
            cursor: pointer;
            color: #7d7d7d;
            display: none;
        }
        #result_help{
            color:#c5c5c5;
            margin-top:35px;
            width:100%;
            display:flex;
            flex-direction:column;
            gap:5px;
            align-items:center;
            justify-content:center;
        }
    </style>
</head>
<body>
    <?php include_once('nav.php');?>
    <br><br><br>

    <div class="search_wrapper">
        <div class="input">
            <i class='bx bx-search' id="icon"></i>
            <input type="text" placeholder="Search" value='<?=$search?>' onkeyup="check_input(event)">
            <i class='bx bx-x' id="clear" onclick="clear_input(this)"></i>
        </div>
    </div>
    
    <section class="movies" id="watch">
        <h2 class="heading">Search Result:</h2>
        <div class="movies-container">
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
               echo "<div id='result_help'><p>Didn't Found What You Looked For?</p><p>Try Being More Specific On Your Search!</p></div>";
             }else{
                if($search != '')
                    echo "<div id='result_help' style='margin-top:70px;margin-bottom:140px;'>Couldn't Find Anything For '$search'</p></div>";
                else
                    echo "<div id='result_help' style='margin-top:70px;margin-bottom:140px;'>Search Results Appear Here!</p></div>";
             }
        ?>
        </div>
    </section>

    <div class="copyright">
        <p>&#169; BakaHen All Rights Reserved.</p>
    </div>

     <script src="script.js"></script>
     <script>
        function check_input(ev)
        {
            let text = ev.target.value;
            if(ev.keyCode == 13)
            {
                // submit search
                if(text.trim() != '')
                    location.href = 'search.php?s='+text.replace(/ /g, '+');;
                return;
            }
            if(text.trim() == '')
            {
                ev.target.nextElementSibling.style.display = 'none';
            }else{
                ev.target.nextElementSibling.style.display = 'block';
            }
        }
        function clear_input(e)
        {
            e.previousElementSibling.value = '';
            e.style.display = 'none';
        }
     </script>
</body>
</html>