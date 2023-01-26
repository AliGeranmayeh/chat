
<?php
require_once "./../helper/helper.php";

session_start();

unset_session("user_existence");
unset_session("user_login-credentials");
unset_session("username");
if (isset($_POST["login"])) {

    $data = file_get_contents(STORAGE . "users.json");
    $data_array = json_decode($data, true);
    $flag = false;

    foreach ($data_array as $item) {
        if ($item["username"] == $_POST['l_username'] && $item["password"] == $_POST['l_password']) {
            $flag = true;
            $_SESSION["username"] = $item["username"];
            break;
        }
    }
    if ($flag) {
        $_SESSION["auth"] = true;
        header("Location: ./../chat/chatconfig.php");
    } else {
        $_SESSION["user_login-credentials"] = "wrong username or password";
        view('auth');
    }
}
if (isset($_POST["register"])) {
    $data = file_get_contents(STORAGE . "users.json");
    $data_array = json_decode($data, true);
    $flag = false;
    if ($data_array != null) {
        foreach ($data_array as $item) {
            if ($item["username"] == $_POST['s_username'] || $item["email"] == $_POST['email']) {
                $flag = true;
                break;
            }
        }
    }
    if (!$flag) {
        $input = array(
            'username' => $_POST['s_username'],
            'email' => $_POST['email'],
            'password' => $_POST['s_password'],
            'name' => $_POST['name'],
            'bio' => "",
            'profile_pic' =>[]
        );
        $_SESSION["username"] =  $_POST['s_username'];
        file_put_contents(STORAGE . "messages.json", json_encode($data, JSON_PRETTY_PRINT));
        $data_array[] = $input;
        $data_array = json_encode($data_array, JSON_PRETTY_PRINT);
        file_put_contents(STORAGE . "users.json", $data_array);
        $_SESSION["auth"] = true;
        header("Location: ./../chat/chatconfig.php");
    } else {
        $_SESSION["user_existence"] = "a user with this email or username ia already signed up";
        view("auth");
    }
}
?>