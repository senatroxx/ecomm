<?php require ('../config.php');
if (empty($_SESSION['admin'])) {
	header ("location: login.php");
}
if (isset($_POST['upload'])) {
	$pp = $_FILES['poto'];
	$nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
	$desk = filter_input(INPUT_POST, 'deskprod', FILTER_SANITIZE_STRING);
	$harga = filter_input(INPUT_POST, 'harga', FILTER_SANITIZE_STRING);
	$stok = filter_input(INPUT_POST, 'stok', FILTER_SANITIZE_STRING);

	$def = new ecomm();
	$add = $def->addprod($pp, $nama, $desk, $harga, $stok);
	if ($add = "Sukses") {
		header("../index.php");
	}
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
		<form action="" method="POST" enctype="multipart/form-data">
		<div class="data">
			<div class="poto">
				<img id="img-prev" src="../img/prod/default.jpg">
				<input id="img-src" type="file" onchange="prevImg()" name="poto">
				<input type="text" name="nama" placeholder="Nama Produk">
			</div>
			<div class="prod">
				<textarea name="deskprod" placeholder="Deskripsi Produk"></textarea>
				<div class="harga">
					<input type="number" name="harga" placeholder="Harga">
				</div>
				<div class="stok">
					<input type="number" name="stok" placeholder="Stok Produk">
				</div>
				<input type="submit" name="upload" value="upload">
			</div>
		</div>
		</form>
	</div>
</div>
</body>
</html>