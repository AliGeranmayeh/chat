<?php
require_once "./../helper/helper.php";
session_start();
$input = [
    "id" => "",
    "username" => "",
    "message" => "",
    "pic" => "",
    "time" => "",
    "seen" => []
];

if (!is_dir("./../img")) {
    mkdir("./../img");
}
$file = $_FILES['userSendedPic'] ?? null;
$path = "";
if (isset($_POST["submit"]) && (!empty($_POST["userText"])) || !empty($file["tmp_name"])) {
    $data = json_decode(file_get_contents(STORAGE . "messages.json"), true);
    if (empty($data)) {
        if (!empty($_POST["userText"]) && $file["tmp_name"] != "") {
            $img_path = './../img/' . generateRandomString() . '/' . $file["name"];
            mkdir(dirname($img_path));
            move_uploaded_file($file["tmp_name"], $img_path);
            $input["id"] = 1;
            $input["username"] = $_SESSION["username"];
            $input["pic"] = $img_path;
            $input["message"] = $_POST["userText"];
            $input["time"] = date("H:i", time() + 9004);
        } elseif (!empty($_POST["userText"])) {
            $input["id"] = 1;
            $input["username"] = $_SESSION["username"];
            $input["message"] = $_POST["userText"];
            $input["time"] = date("H:i", time() + 9004);
        } elseif ($file["tmp_name"] != "") {
            $img_path = './../img/' . generateRandomString() . '/' . $file["name"];
            mkdir(dirname($img_path));
            move_uploaded_file($file["tmp_name"], $img_path);
            $input["id"] = 1;
            $input["username"] = $_SESSION["username"];
            $input["pic"] = $img_path;
            $input["time"] = date("H:i", time() + 9004);
        }
        $data[] = $input;
        file_put_contents(STORAGE . "messages.json", json_encode($data, JSON_PRETTY_PRINT));
        view("chat");
    } else {
        $last_item = end($data);
        $last_item_id = $last_item['id'];
        if (!empty($_POST["userText"]) && $file["tmp_name"] != "") {
            $img_path = './../img/' . generateRandomString() . '/' . $file["name"];
            mkdir(dirname($img_path));
            move_uploaded_file($file["tmp_name"], $img_path);
            $input["id"] = ++$last_item_id;
            $input["username"] = $_SESSION["username"];
            $input["pic"] = $img_path;
            $input["message"] = $_POST["userText"];
            $input["time"] = date("H:i", time() + 9004);
        } elseif (!empty($_POST["userText"])) {
            $input["id"] = ++$last_item_id;
            $input["username"] = $_SESSION["username"];
            $input["message"] = $_POST["userText"];
            $input["time"] = date("H:i", time() + 9004);
        } elseif ($file["tmp_name"] != "") {
            $img_path = './../img/' . generateRandomString() . '/' . $file["name"];
            mkdir(dirname($img_path));
            move_uploaded_file($file["tmp_name"], $img_path);
            $input["id"] = ++$last_item_id;
            $input["username"] = $_SESSION["username"];
            $input["pic"] = $img_path;
            $input["time"] = date("H:i", time() + 9004);
        }
        $data[] = $input;
        file_put_contents(STORAGE . "messages.json", json_encode($data, JSON_PRETTY_PRINT));
        view("chat");
    }
}
if (isset($_POST["edit-btn"]) && !empty($_POST["userText"])) {
    $edited_message = $_POST["userText"];
    $data = json_decode(file_get_contents(STORAGE . "messages.json"), true);
    $i = 0;
    foreach ($data as $key => $item) {
        if ($item["username"] == $_SESSION["username"] && $item["time"] == $_SESSION["e-message-time"] && $item["message"] == $_SESSION["e-message"] && $item["pic"] == $_SESSION["e-message-pic"]) {
            $item["message"] =  $edited_message;
            $data[$key]["message"] =  $edited_message;
            break;
        }
    }
    echo "<br>";
    var_dump($data);
    file_put_contents(STORAGE . "messages.json", json_encode($data, JSON_PRETTY_PRINT));
    view("chat");
} else {
    view("chat");
}
