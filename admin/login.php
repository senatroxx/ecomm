<?php require ('../config.php');
if (isset($_POST['masuk'])) {
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

$def = new ecomm();
$add = $def->loginAdmin($username, $password);
if ($add == "Sukses") {
	header("location: index.php");
}
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>ecommerce.com</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/fontawesome/css/all.min.css">
</head>
<body>
<div class="container2">
	<form action="" method="POST">
		<div class="login">
			<div class="brandlog"><a href="index.php"><b>ecommerce</b>.com</a></div>
			<div class="inputWrap">
				<input class="nginput" type="text" name="username" placeholder="Username or Email">
			</div>
			<div class="inputWrap">
				<input class="nginput" type="password" name="password" placeholder="Password">
			</div>
			<div class="inputWrap">
				<input type="submit" name="masuk" value="Login">
			</div>
		</div>
	</form>
</div>
</body>
</html>