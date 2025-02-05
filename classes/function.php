<?php
require_once "connect.php";
require_once "image.php";
function get_populars()
{
    $DB = new Database();
    $query = "select * from popular order by id desc limit 5";
    $result = $DB->read($query);
    if(!is_array($result))
        return false;
    return $result;
}
function get_anime_info($anime_id,$fields)
{
    $DB = new Database();
    $query = "select $fields from anime_list where anime_id = '$anime_id' limit 1";
    $result = $DB->read($query);
    if(!is_array($result))
        return false;
    else
        return $result[0];
}

function get_search_results($search_string)
{
    $DB = new Database();
    $query = "select anime_id,name,seasons,img from anime_list where name like '%$search_string%' || jp_name like '%$search_string%' limit 10";
    $result = $DB->read($query);
    if(!is_array($result))
        return false;
    else
        return $result;
}
function get_profile($userid)
{
    $DB = new Database();
    $query = "select fname,lname,email from users where userid='$userid' limit 1";
    $result = $DB->read($query);
    if(is_array($result))
    {
        return $result[0];
    }
}
function get_profile_pic($userid)
{
    $DB = new Database();
    $query = "select img from users where userid='$userid' limit 1";
    $result = $DB->read($query);
    if(is_array($result))
    {
        $result = $result[0]['img'];
        if($result != '')
        {
            return $result;
        }else{
            return 'img/profile.jpg';
        }
    }
}
function make_profile_changes($data,$medias,$mydata)
{
    if($medias['profile_img']['name'] != '' || $medias['cover_img']['name'] != '')
    {
        if($medias['profile_img']['name'] != '')
        {
            if($medias['profile_img']['type'] == "image/jpeg")
            {
                $folder = "uploads/" . $_SESSION['user'] . "/";
                if(!file_exists($folder))
                {
                    mkdir($folder,0777,true);
                }
                $image = new Image();
                $filename = $folder . $image->create_filename(15) . ".jpg";
                move_uploaded_file($medias['profile_img']['tmp_name'], $filename);
                $image->resize_image($filename,$filename,800,800);
                if(file_exists($filename))
                {
                        $DB = new Database();
                        $userid = $_SESSION['user'];
                        $query = "select img from users where userid='$userid' limit 1";
                        $result = $DB->read($query);
                        if(is_array($result[0]))
                        {
                            $result = $result[0];
                            if($result['img'] != '')
                            {
                                unlink($result['img']);
                            }
                        }
                        $thumbnail = $folder . $image->create_filename(15) . ".jpg";
                        $image->crop_image($filename,$thumbnail,600,600);
                        unlink($filename);
                        $query = "update users set img = '$thumbnail' where userid = '$userid' limit 1";
                        $DB->save($query);
                }
            }else
            {
                $folder = "uploads/" . $_SESSION['user'] . "/";
                if(!file_exists($folder))
                {
                    mkdir($folder,0777,true);
                }
                $Image = new Image();
                $raw = $Image->create_filename(15);
                $filepng = $folder . $raw . ".png";
                move_uploaded_file($medias['profile_img']['tmp_name'], $filepng);
                $filename = $Image->jpeg_to_png($filepng, $folder.$raw.'.jpg');
                $Image->resize_image($filename,$filename,800,800);
                if(file_exists($filename))
                {
                        $DB = new Database();
                        $userid = $_SESSION['user'];
                        $query = "select img from users where userid='$userid' limit 1";
                        $result = $DB->read($query);
                        if(is_array($result[0]))
                        {
                            $result = $result[0];
                            if($result['img'] != '')
                            {
                                unlink($result['img']);
                            }
                        }
                        $thumbnail = $folder . $Image->create_filename(15) . ".jpg";
                        $Image->crop_image($filename,$thumbnail,600,600);
                        unlink($filename);
                        $query = "update users set img = '$thumbnail' where userid = '$userid' limit 1";
                        $DB->save($query);
                }
            }
        return "success";
        }
    }else{
        $fname = strtolower($data['fname']);
        $lname = strtolower($data['lname']);
        // correction
        {
            if (is_numeric($fname) || strstr($fname, " ") || preg_match('~[0-9]+~', $fname)) {
                return 101;
            }

            if (is_numeric($lname) || strstr($lname, " ") || preg_match('~[0-9]+~', $lname)) {
                return 102;
            }
        }
        // correction
        $fname = addslashes(ucfirst($fname));
        $lname = addslashes(ucfirst($lname));
        $userid = $_SESSION['user'];
        $DB = new Database();
        $query = "update users set fname = '$fname', lname = '$lname' where userid='$userid' limit 1";
        $DB->save($query);
        return "success";
    }
}

function allowed_next_ses($anime_id,$current)
{
    $DB = new Database();
    $result = $DB->read("select season from season where anime_id='$anime_id'");
    if(is_array($result))
    {
        $n = count($result);
        for($i=0;$i<$n;$i++)
        {
            if($current == $result[$i]['season'])
            {
                if($i != ($n-1))
                {
                    if(is_array($result[$i+1]))
                        return 1;
                }
                else
                    return 0;
            }
        }
    }
}
function allowed_prev_ses($anime_id,$current)
{
    $DB = new Database();
    $result = $DB->read("select season from season where anime_id='$anime_id'");
    if(is_array($result))
    {
        $n = count($result);
        for($i=0;$i<$n;$i++)
        {
            if($current == $result[$i]['season'])
            {
                if($i != 0)
                {
                    if(is_array($result[$i-1]))
                        return 1;
                }
                else
                    return 0;
            }
        }
    }
}