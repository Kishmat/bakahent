<?php
session_start();
if(!isset($_SESSION['user']) || $_SESSION['user'] != 645)
{
    header("Location: ../index.php");
    die;
}
$table = 'anime_list';
$limit = 25;
$offset = 0;

if(isset($_GET['table']))
  $table = $_GET['table'];
if(isset($_GET['limit']))
  $limit = $_GET['limit'];
if(isset($_GET['offset']))
  $offset = $_GET['offset'];

$main = false;
if($table == 'anime_list')
{
  $rows = 'id,anime_id,name,jp_name,status,studio,theme,seasons,img,adult';
  $main = true;
}
else
  $rows = '*';

require_once "../classes/connect.php";
$DB = new Database();
$query = "select $rows from $table limit $limit offset $offset";
$result = $DB->read($query);

$anime_count = $DB->read("select count(id) as records from anime_list");
$anime_count = $anime_count[0]['records'];
$user_count = $DB->read('select count(id) as records from users');
$user_count = $user_count[0]['records'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    *{
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body{
      font-family: Arial, Helvetica, sans-serif;
      height: 100vh;
      background: #232323;
      color: white;
    }
    th,td{
      user-select: none;
      padding: 10px 15px;
    }
    td{
      font-size: 15px;
      position: relative;
    }
    td .input{
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      outline: none;
    }
    table{
      border-collapse: collapse;
    }

    .infos{
      margin-top: 20px;
      display: flex;
      flex-direction: column;
      gap: 25px;
      align-items: center;
      justify-content: center;
      margin-bottom: 40px;
    }

    .infos .counter_wrapper{
      display: flex;
      gap: 20px;
    }

    .infos .counter_wrapper .counter{
      padding: 40px 70px;
      border-radius: 12px;
      background: #2a4b8a;
      display: flex;
      flex-direction: column;
      gap: 10px;
      align-items: center;
    }
    .infos .counter_wrapper .another{
      background: #b94343;
    }
    .infos .counter_wrapper .counter .count{
      font-size: 30px;
      font-weight: bold;
    }



    .options{
      display: flex;
      gap: 25px;
      margin-bottom: 30px;
    }

    .options .option select{
      padding: 8px 15px;
      border-radius: 5px;
      border: none;
    }
    .options .special{
      display: flex;
      gap: 10px;
      align-items: center;
    }
    .options .option #new{
      border: none;
      padding: 10px 15px;
      border-radius: 12px;
      cursor: pointer;
    }
    .hscroll {
      overflow-x: auto;
      padding: 10px 20px;
    }

    .long{
      max-height: 100px;
      overflow-y: scroll;
      scrollbar-width: thin;
    }
    tr{
      text-align: center;
    }


    /* CHECKBOX */
     /* The switch - the box around the slider */
      .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
      }

      /* Hide default HTML checkbox */
      .switch input {
        opacity: 0;
        width: 0;
        height: 0;
      }

      /* The slider */
      .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
      }

      .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
      }

      input:checked + .slider {
        background-color: #2196F3;
      }

      input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
      }

      input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
      }

      /* Rounded sliders */
      .slider.round {
        border-radius: 34px;
      }

      .slider.round:before {
        border-radius: 50%;
      } 

    /* CHECKBOX */

  </style>
</head>

<body>

  <div class="infos">

    <h1>Admin Dashboard</h1>
    <div class="counter_wrapper">
      <div class="counter">
        <div class="title">Total Animes</div>
        <div class="count"><?=$anime_count?></div>
      </div>
      <div class="counter another">
        <div class="title">Total Users</div>
        <div class="count"><?=$user_count?></div>
      </div>
    </div>

  </div>

  <div class="options">
    <div class="option">
      Select Table : 
      <select id="table_name" onchange="table(this)">
        <option value="anime_list" <?php if($table == 'anime_list') echo 'selected';?>>Anime Lists</option>
        <option value="popular" <?php if($table == 'popular') echo 'selected';?>>Popular</option>
        <option value="season" <?php if($table == 'season') echo 'selected';?>>Seasons</option>
      </select>
    </div>

    <div class="option">
      Limit : 
      <select id="limit" onchange="limit(this)">
        <option value="25" <?php if($limit == 25) echo 'selected';?>>25</option>
        <option value="50" <?php if($limit == 50) echo 'selected';?>>50</option>
        <option value="75" <?php if($limit == 75) echo 'selected';?>>75</option>
        <option value="100" <?php if($limit == 100) echo 'selected';?>>100</option>
      </select>
    </div>

    <div class="option">
      Offset : 
      <select id="offset" onchange="offset(this)">
        <option value="0" <?php if($offset == 0) echo 'selected';?>>0</option>
        <option value="25" <?php if($offset == 25) echo 'selected';?>>25</option>
        <option value="50" <?php if($offset == 50) echo 'selected';?>>50</option>
        <option value="75" <?php if($offset == 75) echo 'selected';?>>75</option>
        <option value="100" <?php if($offset == 100) echo 'selected';?>>100</option>
      </select>
    </div>

    <div class="option special">
      <div class="mode">
        <label class="switch">
          <input type="checkbox" id="edit_mode">
          <span class="slider round"></span>
        </label>
      </div>
      <p>Edit Mode</p>
    </div>

    <div class="option">
      <button type="button" id="new" onclick="location.href='new.php';">Add New</button>
    </div>
  </div>



  <div class="hscroll">
    <table width="100%" border="1" cellspacing="5" cellpadding="6">
      <tbody id="parent">

        <!-- ANIME_LIST -->
        <tr>
          <?php if($main):?>
            <th>ID</th>
            <th>Anime ID</th>
            <th>Name</th>
            <th>Jp Name</th>
            <th>Status</th>
            <th>Studio</th>
            <th>Theme</th>
            <th>Seasons</th>
            <th>Img</th>
            <th>Adult</th>
          <?php elseif($table == 'season'): ?>
            <th>ID</th>
            <th>Anime ID</th>
            <th>Id Name</th>
            <th>Season</th>
            <th>Season Name</th>
            <th>Ep</th>
            <th>Aired Ep</th>
          <?php else: ?>
            <th>ID</th>
            <th>Anime ID</th>
            <th>Cover</th>
          <?php endif; ?>
        </tr>
        <!-- ANIME_LIST -->
          <?php
            if($main)
            {
              foreach($result as $row)
              {
                echo "<tr>
                <td class='id' ondblclick='delete_row(this)'>$row[id]</td>
                <td ondblclick='edit_value(this)' class='anime_id'>$row[anime_id]</td>
                <td ondblclick='edit_value(this)' class='name'>$row[name]</td>
                <td ondblclick='edit_value(this)' class='jp_name'>$row[jp_name]</td>
                <td ondblclick='edit_value(this)' class='status'>$row[status]</td>
                <td ondblclick='edit_value(this)' class='studio'>$row[studio]</td>
                <td ondblclick='edit_value(this)' class='theme'>$row[theme]</td>
                <td ondblclick='edit_value(this)' class='seasons'>$row[seasons]</td>
                <td ondblclick='edit_value(this)' class='img'>$row[img]</td>
                <td ondblclick='edit_value(this)' class='adult'>$row[adult]</td>
                </tr>";
              }
            }else{
              if($table == 'season')
              {
                foreach($result as $row)
                {
                  echo "<tr>
                  <td class='id' ondblclick='delete_row(this)'>$row[id]</td>
                  <td ondblclick='edit_value(this)' class='anime_id'>$row[anime_id]</td>
                  <td ondblclick='edit_value(this)' class='id_name'>$row[id_name]</td>
                  <td ondblclick='edit_value(this)' class='season'>$row[season]</td>
                  <td ondblclick='edit_value(this)' class='season_name'>$row[season_name]</td>
                  <td ondblclick='edit_value(this)' class='ep'>$row[ep]</td>
                  <td ondblclick='edit_value(this)' class='aired_ep'>$row[aired_ep]</td>
                  </tr>";
                }
              }
              else{
                foreach($result as $row)
                {
                  echo "<tr>
                  <td class='id' ondblclick='delete_row(this)'>$row[id]</td>
                  <td ondblclick='edit_value(this)' class='anime_id'>$row[anime_id]</td>
                  <td ondblclick='edit_value(this)' class='cover'>$row[cover]</td>
                  </tr>";
                }
              }

            }
          ?>
      </tbody>
    </table>
  </div>

  <script>
    let active = false;
    let edit_mode = document.getElementById("edit_mode");
    function table(e)
    {
      let limit = <?=$limit?>;
      let offset = <?=$offset?>;
      location.replace('admin.php?table='+e.value+'&limit='+limit+'&offset='+offset);
    }
    function limit(e)
    {
      let table = "<?=$table?>";
      let offset = <?=$offset?>;
      location.replace('admin.php?table='+table+'&limit='+e.value+'&offset='+offset);
    }
    function offset(e)
    {
      let table = "<?=$table?>";
      let limit = <?=$limit?>;
      location.replace('admin.php?table='+table+'&limit='+limit+'&offset='+e.value);
    }
    function edit_value(e)
    {
      if(!edit_mode.checked)
        return;
      if(!active)
      {
        active = true;
        let input = document.createElement("input");
        input.type = 'text';
        input.className = 'input';
        input.value = e.textContent;
        let cache_input = input.value;
        e.appendChild(input);
        input.select();

        input.addEventListener('blur',()=>{
          active = false;
          e.removeChild(input);
          if(cache_input == input.value)
            return;
          let ajax = new XMLHttpRequest();
          let data = {};
          data.action = 'edit_field';
          data.table = '<?=$table?>';
          data.id = e.parentElement.firstElementChild.textContent;
          data.field = e.className;
          data.value = input.value.trim();
          data = JSON.stringify(data);

          ajax.addEventListener("readystatechange",function(){
              if(ajax.readyState == 4 && ajax.status == 200)
              {
                if(ajax.responseText == "success")
                {
                  e.textContent = input.value;
                }
              }
          });

          ajax.open("post","../ajax/ajax.php",true);
          ajax.send(data);
        });

      }
    }
    function delete_row(e)
    {
      if(!edit_mode.checked)
        return;
      if(confirm("Are you sure you want to delete this record?")){
        let ajax = new XMLHttpRequest();
        let data = {};
        data.action = 'delete_field';
        data.table = '<?=$table?>';
        data.id = e.textContent;
        data = JSON.stringify(data);

        ajax.addEventListener("readystatechange",function(){
              if(ajax.readyState == 4 && ajax.status == 200)
              {
                if(ajax.responseText == "success")
                {
                  document.getElementById("parent").removeChild(e.parentElement);
                }
              }
          });

        ajax.open("post","../ajax/ajax.php",true);
        ajax.send(data);
      }
    }
  </script>
</body>

</html>