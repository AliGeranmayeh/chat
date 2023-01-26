<?php

require_once "./../helper/helper.php";
session_start();
if (isset($_POST["update_bio"])) {
    $data = json_decode(file_get_contents(STORAGE . "users.json"), true);
    foreach ($data as $key => $value) {
        if ($value["username"] == $_SESSION["username"]) {
            $data[$key]["bio"] = $_POST["bio"];
            $_SESSION["profile_bio"] = $_POST["bio"];
            break;
        }
    }
    file_put_contents(STORAGE . "users.json", json_encode($data, JSON_PRETTY_PRINT));
    view("profile");
}

