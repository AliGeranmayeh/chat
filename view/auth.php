<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
?>

<!DOCTYPE html>
<html>

<head>
	<title>Slide Navbar</title>
	<link rel="stylesheet" href="styles/auth.css">

</head>

<body>
	<?php if(isset( $_SESSION["user_existence"])){ ?>
		<div class="alert"><?php echo $_SESSION["user_existence"]; ?></div>
	<?php } ?>
	<?php if(isset( $_SESSION["user_login-credentials"])){ ?>
		<div class="alert"><?php echo $_SESSION["user_login-credentials"]; ?></div>
	<?php } ?>
	<div class="body">
		<div class="main">
			<input type="checkbox" id="header-chk">
			<div class="signup">
				<form method="post" action="../auth/authconfig.php">
					<label for="header-chk">Sign up</label>
					<input type="text" name="s_username" placeholder="username" required pattern="^[\w_]+$" min="3" max="32" title="username is not acceptable">
					<input type="text" name="name" placeholder="name" required pattern="^[a-z ]+$" min="3" max="32" title="name is not acceptable">
					<input type="email" name="email" placeholder="email" required pattern="^[\w-\.]+@([\w-]+\.)+[\w-]{2,}$" title="email is not acceptable">
					<input type="password" name="s_password" placeholder="password" required min="3" max="32">
					<button type="submit" name="register">Sign up</button>
				</form>
			</div>

			<div class="login">
				<form method="post" action="../auth/authconfig.php">
					<label for="header-chk">Login</label>
					<input type="text" name="l_username" placeholder="username" required pattern="^[\w_]+$" min="3" max="32" title="username is not acceptable">
					<input type="password" name="l_password" placeholder="Password" required min="3" max="32">
					<button type="submit" name="login">Login</button>
				</form>
			</div>
		</div>
	</div>
</body>

</html>