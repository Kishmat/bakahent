<?php
session_start();
require_once "../classes/connect.php";
$data = file_get_contents("php://input");
if($data != "")
{
	$data = json_decode($data);
}
if(isset($data->action))
{
    $DB = new Database();
    if($data->action == "get_season")
    {
        $result = $DB->read("select season from season where anime_id='$data->anime_id'");
        if(is_array($result))
        {
            $n = count($result);
            for($i=0;$i<$n;$i++)
            {
                if($data->current == $result[$i]['season'])
                {
                    if($data->perform > 0)
                    {
                        echo $result[$i+1]['season'];
                    }else{
                        echo $result[$i-1]['season'];
                    }
                }
            }
        }
    }else if($data->action == "edit_field")
    {
        $DB = new Database();
        $query = "update $data->table set $data->field = '$data->value' where id='$data->id' limit 1";
        $DB->save($query);
        echo "success";
    }else if($data->action == "delete_field")
    {
        $DB = new Database();
        $query = "delete from $data->table where id='$data->id' limit 1";
        $DB->save($query);
        echo "success";
    }
}