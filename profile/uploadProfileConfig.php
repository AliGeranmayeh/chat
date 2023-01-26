<?php
require_once "./../helper/helper.php";
session_start();
$data = json_decode(file_get_contents(STORAGE . "users.json"), true);
if (!is_dir("./pics")) {
    mkdir("./pics");
}
if (!is_dir("./pics/".$_SESSION["username"])) {
    mkdir("./pics/".$_SESSION["username"]);
}
$file = $_FILES["user_pic"];
$path = "";
foreach ($data as $key => $value) {
    if ($_SESSION["username"] == $value["username"]) {
        $img_path = './pics/'.$_SESSION["username"].'/'. generateRandomString() . '/' . $file["name"];
        mkdir(dirname($img_path));
        move_uploaded_file($file["tmp_name"], $img_path);
        $data[$key]["profile_pic"][] = $img_path;
        file_put_contents(STORAGE . "users.json", json_encode($data, JSON_PRETTY_PRINT));
        break;
    }
}
header("Location: ./profileConfig.php");