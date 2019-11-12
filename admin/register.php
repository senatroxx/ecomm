<?php require ('../config.php');
if (isset($_POST['tambahadmin'])) {
	$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
	$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
	$hashed = password_hash($password, PASSWORD_DEFAULT);
	$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);

	$def = new ecomm();
	$add = $def->tambahAdmin($name, $username, $hashed, $email);
}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin - ecommerce.com</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<?php if (isset($_POST['tambahadmin'])) { if ($add = "Sukses") { ?>
<div class="alert sukses">
	<span class="closebtn" onclick="this.parentElement.style.display='none'"></span>
	Akun admin baru sukses ditambahkan :)
</div>
<?php }} ?>
<div class="container">
	<div class="topmenuadd">
		<div class="left">
			<p class="username">Admin</p>
		</div>
		<div class="center">
			<div class="brandadd">
				<a href="index.php"><b>ecommerce</b>.com</a>
			</div>
		</div>
		<div class="right">
			<?php
			 if (isset($_SESSION['admin'])) {
			?>
				<div class="dropdown">
					<div class="profil">
						<?php echo $_SESSION['admin']['nama'] ?>
					</div>
					<div class="dropdown-content">
						<a href="pengaturan.php?id=<?= $_SESSION['admin']['id']; ?>">Pengaturan</a>
						<a href="logout.php">Logout</a>
					</div>
				</div>
			<?php
				}
			 ?>
		</div>
	</div>
	<div class="content" style="margin-top: 40px">
		<div class="menu" >
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="produk.php">Produk</a></li>
				<li><a href="kategori.php">Kategori</a></li>
				<li><a href="order.php">Order</a></li>
				<li><a href="signup.php">+Admin</a></li>
			</ul>
		</div>
		<div class="dataAd">
			<div class="tambah">
				<form action="" method="POST">
					<table align="center">
						<tr>
							<th align="center"><h3>Tambah Admin</h3></th>
						</tr>
						<tr>
							<td><input type="text" name="name" placeholder="Full Name"></td>
						</tr>
						<tr>
							<td><input type="text" name="username" placeholder="Username"></td>
						</tr>
						<tr>
							<td><input type="password" name="password" placeholder="Password"></td>
						</tr>
						<tr>
							<td><input type="email" name="email" placeholder="email"></td>
						</tr>
						<tr>
							<td align="center"><input type="submit" name="tambahadmin" value="+Admin"></td>
						</tr>
					</table>
				</form>
			</div>		
		</div>
	</div>
</div>
</body>
</html>