<?php require ('config.php');
$def = new ecomm();
if (isset($_SESSION['user'])) {
	if (isset($_POST['addtocart'])) {
		$userID = $_SESSION['user']['id'];
		$prodID = $_GET['id'];
		$name = $_POST['hidden_name'];
		$price = $_POST['hidden_price'];
		$qty = $_POST['jumlah'];
		$note = filter_input(INPUT_POST, 'catatan', FILTER_SANITIZE_STRING);
		$add = $def->addtocart($userID, $prodID, $name, $price, $qty, $note);
		if ($add = "Sukses") {
			header("location: cart.php");
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>ecommerce.com</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/fontawesome/css/all.min.css">
</head>
<body>
<div class="container">
	<div class="topmenu">
		<div class="left">
			<form action="search.php" method="GET">
				<button type="submit"><i class="fas fa-search"></i></button>
				<input type="text" name="search" placeholder="Search..">
			</form>
		</div>
		<div class="right">
			<div class="cart">
				<a href="cart.php"><i class="fas fa-shopping-cart"></i> Cart(0)</a>
			</div>
			<?php 
				if (empty($_SESSION['user'])) {
			 ?>
				<div class="login">
					<a href="login.php">Login</a>
					<a class="signup" href="signup.php">Sign Up</a>
				</div>
			<?php 
				} if (isset($_SESSION['user'])) {
			?>
				<div class="dropdown">
					<div class="profil">
						<?php echo $_SESSION['user']['nama'] ?>
					</div>
					<div class="dropdown-content">
						<a href="">Pembelian</a>
						<a href="pengaturan.php?id=<?= $_SESSION['user']['id'] ?>">Pengaturan</a>
						<a href="logout.php">Logout</a>
					</div>
				</div>
			<?php
				}
			 ?>
		</div>
	</div>
	<div class="brand">
		<p><a href="index.php"><b>ecommerce</b>.com</a></p>
		<p class="desc">Your <i>ecommerce</i> tag line</p>
	</div>
	<div class="content">
		<div class="menu">
			<ul>
				<li><a href="index.php">Home</a></li>
				<?php 
					$category = $def->kategoriList();
					while ($data = $category->fetch(PDO::FETCH_OBJ)) {
						echo "
							<li><a href='kategori.php?id=$data->id'>$data->namaktg</a></li>
						";
					}
				 ?>
				<li><a href="">Notebook & Accessories</a></li>
				<li><a href="">Computer Accessories</a></li>
				<li><a href="">Printer & Catridge</a></li>
				<li><a href="">Networking</a></li>
				<li><a href="">Server</a></li>
				<li><a href="">AIO & PC Branded</a></li>
				<li><a href="">Flash Drive & Memory Card</a></li>
				<li><a href="">UPS & Stabilizer</a></li>
				<li><a href="">Audio</a></li>
			</ul>
		</div>
		<div class="main2">
			<?php 
			$id = $_GET['id'];
			$get = $def->getDB();
			$query = "SELECT * FROM produk WHERE id=:id";
			$stmt = $get->prepare($query);
			$stmt->execute(array(':id' => $id));
			$data = $stmt->fetch(PDO::FETCH_OBJ);
			$rp = "Rp. ".number_format($data->hargabrg, 2,',','.');
			 ?>
			<div class="left">
				<div class="image-produk">
					<img src="img/prod/<?= $data->poto ?>">
				</div>
			</div>
			<div class="right">
				<div class="judul-produk">
					<p><?= $data->namaprod ?></p>
				</div>
				<div class="harga-produk">
					<p><?= $rp ?></p>
				</div>
				<div class="stok-produk">
					<p>Stok: <?php if ($data->jumlahbrg > 0) {
						echo "Ready Stok!!";
					}else{
						echo "SOLD OUT";
					} ?></p>
				</div>
				<form action="produk.php?action=add&id=<?= $data->id ?>" method="POST">
					<div class="catatan-penjual">
						<input type="text" name="catatan" placeholder="Catatan untuk Penjual">
					</div>
					<div class="jumlah-beli">
						<span>Jumlah:</span>
						<input type="number" name="jumlah" value="1">
					</div>
					<input type="hidden" name="hidden_name" value="<?= $data->namaprod ?>">
					<input type="hidden" name="hidden_price" value="<?= $data->hargabrg ?>">
					<div class="addtocart"><button type="submit" name="addtocart">Add to Cart <i class="fas fa-shopping-cart"></i></button></div>
				</form>
			</div>
			<div class="deskripsi">
				<h2>Deskripsi Produk</h2>
				<?= $data->deskprod ?>
			</div>
		</div>
	</div>
</div>
</body>
</html>