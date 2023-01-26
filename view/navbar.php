<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles/navbar.css" />
  <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
  <title>navbar</title>
</head>

<body>
  <input type="checkbox" id="active" />
  <label for="active" class="menu-btn" style="z-index: 52;"><i class="fas fa-bars"></i></label>
  <nav class="wrapper" style="z-index: 50;">
    <ul>
      <li><a href="./chat.php">Chat</a></li>
      <li><a href="./../profile/profileConfig.php">Profile</a></li>
      <li><a href="./../auth/logoutconfig.php">Logout</a></li>
    </ul>
  </nav>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>

</html>