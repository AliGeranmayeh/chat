<?php
require_once "./../helper/helper.php";
session_start();
var_dump($_POST["delete_input"]);

$data = json_decode(file_get_contents(STORAGE . "users.json"), true);
$directory_path = explode("/", $_POST["delete_input"]);

var_dump($directory_path);

foreach ($data as $key => $item) {
    if ($item["username"] == $_SESSION["username"]) {
        foreach ($item["profile_pic"] as $key2=> $value) {
            if ($item["profile_pic"][$key2] == $_POST["delete_input"]) {

                // var_dump($item);
                // var_dump($item["profile_pic"]);
                // var_dump($value);

                    
                unset($data[$key]["profile_pic"][$key2]);
                unlink($data[$key]["profile_pic"][$key2]);
                rmdir($directory_path[0] . "/" . $directory_path[1] . "/" . $directory_path[2] . "/" . $directory_path[3]."/");
                break;
            }
        }
    }
}
file_put_contents(STORAGE . "users.json", json_encode($data, JSON_PRETTY_PRINT));
header("Location: ./profileConfig.php");