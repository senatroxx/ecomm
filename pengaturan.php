<?php require ('config.php'); 

$dbConn = new ecomm();
$db = $dbConn->getDB();

$select = "SELECT * FROM users WHERE id=:id";
$stmt = $db->prepare($select);
if ($stmt->execute(array(':id' => $_GET['id']))) {
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST['gantipp'])) {
	$pp = $_FILES['pp'];
	$data = $result;
	$send = $dbConn->gantipp($pp, $data);
}

if (isset($_POST['change'])) {
	$id = $_GET['id'];
	$nama = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
	$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
	$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
	$telp = filter_input(INPUT_POST, 'number', FILTER_SANITIZE_STRING);
	$address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
	$send = $dbConn->changeData($id, $nama, $username, $email, $telp, $address);
}

if (isset($_POST['subpassword'])) {
	$id = $_GET['id'];
	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
	$password1 = filter_input(INPUT_POST, 'password1', FILTER_SANITIZE_STRING);
	$hashed = password_hash($_POST['password1'], PASSWORD_DEFAULT);
	$send = $dbConn->changePw($id, $password, $password1);
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
		<div class="pp">
			<form action="" method="POST" enctype="multipart/form-data">
				<table>
					<tr>
						<td align="center"><img id="img-prev" src="img/pp/<?= $result['profil'] ?>"></td>
					</tr>
					<tr>
						<td align="center"><input id="img-src" type="file" name="pp" onchange="prevImg();"></td>
					</tr>
					<tr>
						<td align="center"><input type="submit" name="gantipp" value="Ganti"></td>
					</tr>
				</table>
			</form>
		</div>
		<div class="data">
		<div class="datadata">
			<form action="" method="POST">
				<table>
					<tr>
						<td>Full Name</td>
						<td><input type="text" name="name" value="<?= $result['nama'] ?>"></td>
					</tr>
					<tr>
						<td>Username</td>
						<td><input type="text" name="username" value="<?= $result['username'] ?>"></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><input type="email" name="email" value="<?= $result['email'] ?>"></td>
					</tr>
					<tr>
						<td>Phone Number</td>
						<td><input type="number" name="number" value="<?= $result['telp'] ?>"></td>
					</tr>
					<tr>
						<td>Address</td>
						<td><textarea name="address"><?= $result['address'] ?></textarea></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><input type="submit" name="change" ></td>
					</tr>
				</table>
			</form>
		</div>
		<div class="password">
			<p>Password</p>
			<button class="trigger">Ganti Password</button>
		</div>
		</div>
	</div>
	<div class="footer">
		<p class="brand" href="index.php"><b>ecommerce</b>.com</p>
		<p>Made with <i style="color:red" class="fas fa-heart"></i> By Athharkautsar</p>
	</div>
</div>
<div class="modal">
	<div class="modal-content">
		<form action="" method="POST">
			<span class="closeButton">&times;</span>
			<table align="center">
				<tr>
					<td><input type="text" name="password" placeholder="Password Lama"></td>
				</tr>
				<tr>
					<td><input type="text" name="password1" placeholder="Password Baru"></td>
				</tr>
				<tr>
					<td align="center"><input type="submit" name="subpassword" value="Ganti Password"></td>
				</tr>
			</table>
		</form>
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

	let modal = document.querySelector('.modal');
	let trigger = document.querySelector('.trigger');
	let close = document.querySelector('.closeButton');

	function toggleModal() {
		modal.classList.toggle("show-modal");
	};

	function windowOnClick(event) {
		if (event.target === modal) {
			toggleModal();
		}
	}
	if (trigger) {trigger.addEventListener("click", toggleModal);}
	if (close) {close.addEventListener("click", toggleModal);}
	window.addEventListener("click", windowOnClick);

</script>
</body>
</html>