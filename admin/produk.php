<?php require ('../config.php');
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
	<div class="main3">
		<div class="tambah">
			<a href="tmbhprod.php">Tambah Produk</a>
		</div>
		<table>
			<tr>
				<td width="20px">ID</td>
				<td width="150px">Foto Barang</td>
				<td width="200px">Nama Barang</td>
				<td width="200px">Deskripsi Barang</td>
				<td width="150px">Harga Barang</td>
				<td>Stok Barang</td>
				<td>Options</td>
			</tr>
			<?php 
				$def = new ecomm();
				$select = $def->produkList();
				while ($data = $select->fetch(PDO::FETCH_OBJ)) {
					$rp = "Rp. ".number_format($data->hargabrg, 2,',','.');
					echo 
					"<tr>
						<td>$data->id</td>
						<td><img src='../img/prod/$data->poto'></td>
						<td>$data->namaprod</td>
						<td>$data->deskprod</td>
						<td>$rp</td>
						<td>$data->jumlahbrg</td>
						<td><a href='edit.php?id=$data->id'>Edit</a><br><a href='hapus.php?id=$data->id'>Hapus</a></td>
					</tr>";
				}
			 ?>
		</table>
	</div>
</div>
<script type="text/javascript">
	function prevImg() {
		document.getElementById('img-prev').style.display = "block";
		document.getElementById('img-prev').style.width = "100%";
		var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById('img-src').files[0]);

		oFReader.onload=function(oFREvent){
			document.getElementById('img-prev').src = oFREvent.target.result;
		};
	};
</script>
</body>
</html>