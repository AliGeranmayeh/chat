<?php
require_once "./navbar.php";
require_once "./../helper/helper.php";
error_reporting(E_ERROR | E_PARSE);
session_start();
if (isset($_POST["edit"])) {
    $_SESSION["e-message"] = $_POST["edit-message"];
    $_SESSION["e-message-time"] = $_POST["e-message-time"];
    $_SESSION["e-message-pic"] = $_POST["e-message-pic"];
    
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/chat.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <title>chat</title>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.css" integrity="sha512-0Nyh7Nf4sn+T48aTb6VFkhJe0FzzcOlqqZMahy/rhZ8Ii5Q9ZXG/1CbunUuEbfgxqsQfWXjnErKZosDSHVKQhQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.js" integrity="sha512-aGWPnmdBhJ0leVHhQaRASgb0InV/Z2BWsscdj1Vwt29Oic91wECPixuXsWESpFfCcYPLfOlBZzN2nqQdMxlGTQ==" crossorigin="anonymous" referre ></script>
</head>

<body>
    
    <section class="msger">
        <main class="msger-chat">   
            <?php
            if ($_SESSION["auth"]==false) {
                view("auth");
            }
            $data = json_decode(file_get_contents(STORAGE . "messages.json"), true);
            if (!empty($data)) { ?>
                <?php
                foreach ($data as $mess) {
                    if ($mess["username"] == $_SESSION["username"]) { ?>
                        <div class="msg right-msg">
                            <div class="msg-bubble">
                                <div class="msg-info">
                                    <div class="msg-info-name">me</div>
                                    <div class="msg-info-time"><?php echo $mess["time"]; ?></div>
                                </div>
                                <div class="msg-text" style="font-size:19px;">
                                    <?php

                                    if (!empty($mess["message"]) && $mess["pic"] == null) {
                                        echo $mess["message"];
                                    } else { ?>
                                        <img src="../chat<?php echo  $mess["pic"] ?>" alt="image" style="max-height: 500px; max-width:500px;">
                                        <div><?php echo $mess["message"]; ?></div>
                                    <?php } ?>
                                </div>
                                <?php
                                if (!empty($mess["message"])) { ?>
                                    <div class="d-flex my-1">
                                        <?php if (!$mess["read"]) { ?>
                                        <i class="bi bi-check2" style="font-size:19px;"></i>
                                        <?php } ?>
                                        <?php if ($mess["read"]) { ?>
                                            <i class="bi bi-check2-all" style="font-size:19px; color:chartreuse"></i>
                                        <?php } ?>
                                        <form method="post">
                                            <input type="hidden" name="edit-message" value="<?php echo $mess["message"]; ?>">
                                            <input type="hidden" name="e-message-time" value="<?php echo $mess["time"]; ?>">
                                            <input type="hidden" name="e-message-pic" value="<?php echo $mess["pic"]; ?>">
                                            <button style="font-size: 10px; " type="submit" name="edit" class="p-1 btn btn-warning mx-1 ">EDIT</button>
                                        </form>
                                        <form action="./../chat/deleteconfog.php" method="post">
                                            <input type="hidden" name="delete_input" value="<?php echo $mess["message"]; ?>,,,<?php echo $mess["time"]; ?>,,,<?php echo $mess["pic"]; ?>">
                                            <button style="font-size: 10px; " type="submit" name="delete" class="p-1 btn btn-danger mx-1 ">DELETE</button>
                                        </form>
                                    </div>
                                <?php } ?>
                                <div style="color: black; font-size:10px"><?php
                                    foreach ($mess["seen"] as $value) {
                                        if ($_SESSION["username"]==$value) {
                                            continue;
                                        }
                                        else {
                                            echo $value." ";
                                        }
                                        
                                    }
                                ?></div>
                                <?php
                                if (empty($mess["message"])) { ?>
                                    <div class="d-flex my-1">
                                    <?php if (!$mess["read"]) { ?>
                                        <i class="bi bi-check2" style="font-size:19px;"></i>
                                        <?php } ?>
                                        <?php if ($mess["read"]) { ?>
                                            <i class="bi bi-check2-all" style="font-size:19px; color:chartreuse"></i>
                                        <?php } ?>
                                        <form action="./../chat/deleteconfog.php" method="post">
                                            <input type="hidden" name="delete_input" value="<?php echo $mess["message"]; ?>,,,<?php echo $mess["time"]; ?>,,,<?php echo $mess["pic"]; ?>">
                                            <button style="font-size: 10px; " type="submit" name="delete" class="p-1 btn btn-danger mx-1 ">DELETE</button>
                                        </form>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                    <?php } ?>
                    <?php if ($mess["username"] != $_SESSION["username"]) { ?>
                        <div class=" msg left-msg">
                            <div class="msg-bubble">
                                <div class="msg-info">
                                    <div class="msg-info-name"><?php echo $mess["username"]; ?></div>
                                    <div class="msg-info-time"><?php echo $mess["time"]; ?></div>
                                </div>
                                <div class="msg-text" style="font-size:19px;">
                                    <?php
                                    if (!empty($mess["message"]) && $mess["pic"] == null) {
                                        echo $mess["message"];
                                    } else { ?>
                                        <img src="<?php echo "../chat/" . $mess["pic"] ?>" alt="image" style="max-height: 500px; max-width:500px;">
                                        <div class="msg-info-time"><?php echo $mess["message"]; ?></div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </main>
                                        
        <form class="msger-inputarea" action="./../chat/chatconfig.php" method="post" enctype="multipart/form-data">
            <input  name="userText" type="text" class="msger-input" placeholder="Enter your message..." value="<?php echo isset($_POST["edit"]) ? $_POST["edit-message"] : "" ?>" pattern="^{,100}$" title="character limit is 100">
            <input name="userSendedPic" style="display: none;" id="file1" type="file" data-multiple-caption="{count} files selected" multiple />
            <label for="file1" style="padding-bottom:0px;padding-top:0px;"><i class="bi bi-image" style="font-size:30px;cursor: pointer; padding:0;"></i></label>
            <button type="submit" class="msger-send-btn" name="<?php echo isset($_POST["edit"])? "edit-btn": "submit" ?>">Send</button>
        </form>
    </section>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- <script type="text/javascript">
        $(document).ready(function() {
            $(".msger-input").emojioneArea();
        });
    </script> -->
</body>

</html>