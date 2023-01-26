
<?php
const VIEW =  "./../view/";
const STORAGE = "./../storage/";

function view(string $view)
{
    $view = VIEW . $view . ".php";
    if (file_exists($view)) {
        header("Location: $view");
        return true;
    } else {
        header("Location: " . VIEW . "404.html");
        return false;
    }
}
function unset_session(string $string)
{
    if (isset($_SESSION[$string])) {
        unset($_SESSION[$string]);
    }
}
function logout()
{
    unset_session("username");
}

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>