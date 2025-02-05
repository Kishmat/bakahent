<?php
$page = 1;
if(isset($_GET['page']) && is_numeric($_GET['page']))
{
  $page = $_GET['page'];
  if($page <= 0)
    $page = 1;
}
require_once "classes/connect.php";
require_once "classes/function.php";

$DB = new Database();

$query = "select id from anime_list order by id desc limit 1";
$counts = 1;
$counts = $DB->read($query);
if(is_array($counts))
  $counts = $counts[0]['id'];


// query datas
$limit = 20;
$offset = ($page-1)*$limit;
// query datas


$max_pagination = $counts/$limit;
if($offset > $counts)
{
  $page = 1;
  $offset = 0;
}


$query = "select anime_id,img,name,seasons from anime_list order by id desc limit $limit offset $offset";
$result = $DB->read($query);

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
      .movies .movies-container .pagination{
        margin-top: 50px;
        display: flex;
        gap: 10px;
        align-items: center;
        width: 100%;
        justify-content: center;
      }
      .movies .movies-container .pagination>*:hover{
        background: orange;
        color: black;
      }
      .movies .movies-container .pagination .page{
        padding: 5px 15px;
        cursor: pointer;
      }
      .movies .movies-container .pagination .page.active{
        background: orange;
        color: black;
      }
      .movies .movies-container .pagination .actn{
        padding: 5px 10px;
        cursor: pointer;
        border: 1px solid orange;
      }
      .movies .movies-container .pagination .actn.disabled{
        color: #8a8a8a;
        cursor: not-allowed;
      }
      .movies .movies-container .pagination .actn.disabled:hover{
        background: transparent;
      }
    </style>
</head>
<body>
    <?php include_once('nav.php');?>
    <br><br>
     <!-- movies -->
      <section class="movies" id="watch">
        <h2 class="heading">Watch</h2>
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
              <div class="pagination">
                  <?php
                    if($page > 1)
                      echo "<div onclick='action_page(-1)' class='actn'>< Previous</div>";
                  ?>
                  <?php
                      if($counts <= 20)
                      {
                        echo "<div onclick='change_page(this)' class='page active'>1</div>";
                      }else{
                          if(round($max_pagination) == 1)
                          {
                            if($page == 1){
                                echo "<div onclick='change_page(this)' class='page active'>1</div>";
                                echo "<div onclick='change_page(this)' class='page'>2</div>";
                            }else{
                                echo "<div onclick='change_page(this)' class='page'>1</div>";
                                echo "<div onclick='change_page(this)' class='page active'>2</div>";
                            }
                          }else{
                            if($page != 1)
                              echo "<div onclick='change_page(this)' class='page'>",$page-1,"</div>";
                            echo "<div onclick='change_page(this)' class='page active'>",$page,"</div>";
                          }
                      }
                  ?>
                  <?php
                    if($page < $max_pagination)
                      echo "<div onclick='action_page(1)' class='actn'>Next ></div>";
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

     <script src="script.js"></script>
     <script>
      const curr_page = <?=$page?>;

      function change_page(page)
      {
        if(curr_page == page.textContent)
          return;
        location.href = "discover.php?page="+page.textContent;
      }
      function action_page(value)
      {
        let now_page = curr_page + value;
        location.href = "discover.php?page="+now_page;
      }
     </script>
</body>
</html>