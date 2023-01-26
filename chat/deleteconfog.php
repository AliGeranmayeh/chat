<?php
require_once "./../helper/helper.php";
session_start();
$user_message = explode(",,,",$_POST["delete_input"]);
$data = json_decode(file_get_contents(STORAGE . "messages.json"), true);
var_dump(explode("/",$user_message[2]));
$directory_path=explode("/",$user_message[2]);
foreach ($data as $key=>$item) {
    if ($item["username"]==$_SESSION["username"]&&$item["time"]==$user_message[1]&&$item["message"]==$user_message[0]&&$item["pic"]==$user_message[2]) {
        unset($data[$key]);
        unlink($user_message[2]);
        rmdir($directory_path[0]."/".$directory_path[1]."/".$directory_path[2]."/".$directory_path[3]);
        break;
    }
}
file_put_contents(STORAGE . "messages.json", json_encode($data, JSON_PRETTY_PRINT));
view("chat");
?>