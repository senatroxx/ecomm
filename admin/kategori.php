<?php require ('../config.php');
if (empty($_SESSION['admin'])) {
	header ("location: login.php");
}
if (isset($_POST['newcat'])) {
	$kategori = filter_input(INPUT_POST, 'kategori', FILTER_SANITIZE_STRING);
	$def = new ecomm();
	$add = $def->addCatg($kategori);
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
	<div class="main3">
		<div class="tambah">
			<form action="" method="POST">
				<input type="text" name="kategori" placeholder="Nama Kategori"><input type="submit" name="newcat" value="Tambah Kategori">
			</form>
		</div>
		<table>
			<tr>
				<td>ID</td>
				<td>Nama Kategori</td>
				<td>Options</td>
			</tr>
			<?php 
				$def = new ecomm();
				$select = $def->kategoriList();
				while ($data = $select->fetch(PDO::FETCH_OBJ)) {
					echo 
					"<tr>
						<td>$data->id</td>
						<td>$data->namaktg</td>
						<td><a href='hapus.php?id=$data->id'>Hapus</a></td>
					</tr>";
				}
			 ?>
		</table>
	</div>
</div>
</body>
</html>