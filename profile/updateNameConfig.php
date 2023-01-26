<?php
require_once "./../helper/helper.php";
session_start();
if (isset($_POST["update_name"])) {
    $data = json_decode(file_get_contents(STORAGE . "users.json"), true);
    foreach ($data as $key => $value) {
        if ($value["username"] == $_SESSION["username"]) {
            $data[$key]["name"] = $_POST["name"];
            $_SESSION["profile_name"] = $_POST["name"];
            break;
        }
    }
    file_put_contents(STORAGE . "users.json", json_encode($data, JSON_PRETTY_PRINT));
    view("profile");
}
