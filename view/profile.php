<?php
require_once "./navbar.php";
require_once "./../helper/helper.php";
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>profile</title>
    <link rel="stylesheet" href="./styles/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <?php if (!$_SESSION["auth"]) {
        view("auth");
    }?>
    <section class="h-100 gradient-custom-2">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-9 col-xl-7 p-0">
                    <div class="card b-0">
                        <div class="rounded-top text-white d-flex flex-row" style="background-color: #000; height:200px;">
                            <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                                <img src="./../profile/<?php echo $_SESSION["profile_standing_picture"] ?>" alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2" style="width: 150px;max-height:150px; z-index: 1">
                            </div>
                            <div class="ms-3" style="margin-top: 130px;">
                                <h5><?php echo $_SESSION["profile_name"] ?></h5>
                                <p><?php echo $_SESSION["profile_bio"] ?></p>
                            </div>
                        </div>
                        <div class="p-4 text-black" style="background-color: #f8f9fa;">
                            <form action="./../profile/uploadProfileConfig.php" method="post" enctype="multipart/form-data" class=" mt-3">
                                <input type="file" name="user_pic" style="display: none;" id="user_pic" data-multiple-caption="{count} files selected" multiple required />
                                <label for="user_pic" style=" display: inline-block;background-color: indigo;color: white;padding: 6px;font-family: sans-serif;border-radius:6px;cursor: pointer;">Choose file</label>
                                <button name="submit" type="submit" class="btn btn-outline-dark" data-mdb-ripple-color="dark" style="z-index: 1; padding:6px">Upload</button>
                            </form>
                        </div>

                        <div class="card-body p-4 text-black">
                            <?php
                            $data = json_decode(file_get_contents(STORAGE . "users.json"), true);
                            foreach ($data as $key => $value) {
                                if ($_SESSION["username"] == $value["username"] && $value["profile_pic"] != []) { ?>
                                    <div class="mb-4">
                                        <p class="lead fw-normal mb-0">Profile Pictures</p>
                                    </div>
                                    <div class="row">
                                    <?php foreach ($value["profile_pic"] as $key2=> $val) {
                                        ?>
                                            <form class="col mb-2" method="post" action="./../profile/deleteProfileConfig.php" enctype="multipart/form-data">
                                                <button name="profiles" style="display: none;" id="pics<?= $key2?>" type="submit" data-multiple-caption="{count} files selected"></button>
                                                <label for="pics<?= $key2?>" style="position:absolute;cursor: pointer;"><i class="bi bi-trash3-fill" style="color:red;"></i></label>
                                                <input type="hidden" name="delete_input" value="<?= $value["profile_pic"][$key2] ?>">
                                                <img src="./../profile/<?php echo $val ?>" alt="image 1" style="width: 150px;max-height:150px;" class="rounded-3">
                                            </form>
                             <?php } ?>
                                    </div>
                                <?php
                                }
                            }
                            ?>

                            <div class="mb-1">
                                <p class="lead fw-normal mt-3">Edit</p>
                                <div class="p-4" style="background-color: #f8f9fa; border-radius:5px;">
                                    <form action="./../profile/updateNameConfig.php" method="post" class="row g-2">
                                        <div class="col">
                                            <input class="inputs" type="text" name="name" placeholder="your new name..." required pattern="^[a-z ]+{3,32}$" title="name is not acceptable" style="width: 60%;height: 40px;background: #e0dede;margin: 20px auto; padding: 10px;border: none;outline: none;border-radius: 5px;">
                                            <button type="submit" name="update_name" class="btn btn-outline-dark mx-3" data-mdb-ripple-color="dark" style="z-index: 1;">Update</button>
                                        </div>
                                    </form>
                                    <form action="./../profile/updateBioConfig.php" method="post" class="row g-2">
                                        <div class="col">
                                            <input class="inputs" type="text" name="bio" placeholder="your new bio..." required pattern="^[\w_]+{1,40}$" title="bio is not acceptable" style="width: 60%;height: 40px;background: #e0dede;margin: 20px auto; padding: 10px;border: none;outline: none;border-radius: 5px;">
                                            <button name="update_bio" class="btn btn-outline-dark mx-3" data-mdb-ripple-color="dark" style="z-index: 1;">Update</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>