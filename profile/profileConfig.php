<?php
require_once "./../helper/helper.php";
 
session_start();
$data = json_decode(file_get_contents(STORAGE . "users.json"), true);
foreach ($data as $key => $value) {
    if ($value["username"] == $_SESSION["username"]) {
        $_SESSION["profile_name"] = $value["name"];
        $_SESSION["profile_bio"] = $value["bio"];
        if ($value["profile_pic"]==[]) {
            $_SESSION["profile_standing_picture"] = "pics/defualt_profile.png";
        }
        else{
            $_SESSION["profile_standing_picture"] = end($value["profile_pic"]);
        }
        break;
    }
}
file_put_contents(STORAGE . "users.json", json_encode($data, JSON_PRETTY_PRINT));
view("profile");
