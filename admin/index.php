<?php session_start();
if (empty($_SESSION['admin'])) {
	header ("location: login.php");
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin - ecommerce.com</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<div class="container">
	<div class="topmenuadd">
		<div class="left">
				<div class="dropdown">
					<div class="profil">
						<?php echo $_SESSION['admin']['nama'] ?>
					</div>
					<div class="dropdown-content">
						<a href="pengaturan.php?id=<?= $_SESSION['admin']['id']; ?>">Pengaturan</a>
						<a href="logout.php">Logout</a>
					</div>
				</div>
		</div>
		<div class="center">
			<div class="brandadd">
				<a href="index.php"><b>ecommerce</b>.com</a>
			</div>
		</div>
		<div class="right">
			<div class="logout">
				<a href="../logout.php">Logout</a>
			</div>
		</div>
	</div>
	<div class="content" style="margin-top: 40px">
		<div class="menu" >
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="user.php">User List</a></li>
				<li><a href="produk.php">Produk</a></li>
				<li><a href="kategori.php">Kategori</a></li>
				<li><a href="order.php">Order</a></li>
				<li><a href="register.php">+Admin</a></li>
			</ul>
		</div>
		<div class="main3" style="text-align: center">
			<p>Selamat datang, <?php echo $_SESSION['admin']['nama'] ?></p>
			<p>Semoga harimu menyenangkan :)</p>
		</div>
	</div>
</div>
</body>
</html>