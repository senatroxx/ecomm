<?php require 'config.php';
if (isset($_POST['signup'])) {
$name = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$number = filter_input(INPUT_POST, 'number', FILTER_SANITIZE_STRING);
$address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$hashed = password_hash($password, PASSWORD_DEFAULT);
$pp = $_FILES['pp'];

$def = new ecomm();
$add = $def->signup($name, $username, $email, $number, $address, $hashed, $pp);
if ($add == "Sukses") {
	header("location: index.php");
}
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>ecommerce.com</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="container2">
	<form action="" method="POST" enctype="multipart/form-data">
		<div class="login">
			<div class="brandlog"><a href="index.php"><b>ecommerce</b>.com</a></div>
			<div class="inputWrap">
				<input class="nginput" type="text" name="nama" placeholder="Full Name">
			</div>
			<div class="inputWrap">
				<input class="nginput" type="username" name="username" placeholder="Username">
			</div>
			<div class="inputWrap">
				<input class="nginput" type="email" name="email" placeholder="E-mail">
			</div>
			<div class="inputWrap">
				<input class="nginput" type="number" name="number" placeholder="Phone Number">
			</div>
			<div class="inputWrap">
				<textarea name="address">Full Address</textarea>
			</div>
			<div class="inputWrap">
				<input class="nginput" type="password" name="password" placeholder="Password">
			</div>
			<div class="inputWrap">
				<p>Profil Picture</p>
				<input type="file" name="pp" value="Profile Picture">
			</div>
			<div class="inputWrap">
				<input type="submit" name="signup" value="Sign Up!">
			</div>

		</div>
	</form>
</div>
</body>
</html>