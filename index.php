<?php require ('config.php'); ?>
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
					$def = new ecomm();
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
		<div class="main">
			<?php 
				$prod = $def->produkList();
				while ($data2 = $prod->fetch(PDO::FETCH_OBJ)) {
					$rp = "Rp. ".number_format($data2->hargabrg, 2,',','.');
					echo "
					<div class='produk'>
						<a href='produk.php?id=$data2->id'>
						<div class='image'><img src='img/prod/$data2->poto'></div>
						<div class='judul'><a href='produk.php?id=$data2->id'>$data2->namaprod</a></div>
						<div class='harga'>$rp</div>
						</a>
					</div>
					";
				}
			 ?>
		</div>
	</div>
	<div class="footer">
		<p class="brand" href="index.php"><b>ecommerce</b>.com</p>
		<p>Made with <i style="color:red" class="fas fa-heart"></i> By Athharkautsar</p>
	</div>
</div>
</body>
</html>