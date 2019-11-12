<?php 
session_start();
/**
 * ecommerce.com
 */
class ecomm
{
	var $db;
	function __construct()
	{
		$driver = "mysql";
		$host = "localhost";
		$dbname = "ecomm2";
		$charset = "utf8mb4";

		$user = "root";
		$pw = "";
		$options = NULL;

		$dsn = "${driver}:host=${host};dbname=${dbname};charset=${charset}";
		try {
			$this->db = new PDO($dsn, $user, $pw, $options);
		} catch (\PDOExpection $e) {
			throw new \PDOExpection($e->getMassage(), (int)$e->getCode());
		}
	}

	public function getDB()
	{
		return $this->db;
	}

	public function signup($name, $username, $email, $number, $address, $hashed, $pp)
	{
		// PP
		$namapp = $pp['name'];
		$loctmp = $pp['tmp_name'];

		$allowed = array('png', 'jpg', 'jpeg');
		$x = explode('.', $namapp);
		$eks = strtolower(end($x));
		$newfilename = mt_rand(1,99).$username.'.'.$eks;

		if (in_array($eks, $allowed) === TRUE) {
			move_uploaded_file($loctmp, 'img/pp/'.$newfilename);
			$sql = "INSERT INTO users (nama, username, email, telp, address, password, profil) VALUES (:nama, :username, :email, :telp, :address, :password, :profil)";
			$stmt = $this->db->prepare($sql);
			$stmt->execute(array(':nama' => $name, ':username' => $username, ':email' => $email, ':telp' => $number, ':address' => $address, ':password' => $hashed, ':profil' => $newfilename));
			if (!$stmt) {
				return "Gagal";
			}else{
				return "Sukses";
			}
		}
	}

	public function login($username, $password)
	{
		$select = "SELECT * FROM users WHERE username=:username OR email=:email LIMIT 1";
		$stmt = $this->db->prepare($select);
		if ($stmt->execute(array(':username' => $username, ':email' => $username))) {
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			if (password_verify($password, $result['password'])) {
				$_SESSION['user'] = $result;
				return "Sukses";
			}else{
				return "Gagal";
			}
		}else{
			return "DBGagal";
		}
	}

	public function gantipp($pp, $result)
	{
		$id = $result['id'];
		// PP
		$namapp = $pp['name'];
		$loctmp = $pp['tmp_name'];

		$allowed = array('png', 'jpg', 'jpeg');
		$x = explode('.', $namapp);
		$eks = strtolower(end($x));
		$newfilename = mt_rand(1,99).$result['username'].'.'.$eks;

		if (in_array($eks, $allowed) === TRUE) {
			$dir = 'img/pp/'.$result['profil'];
			if (file_exists($dir)) {
				unlink($dir);
			}
			move_uploaded_file($loctmp, 'img/pp/'.$newfilename);
			$sql = "UPDATE users SET profil=:profil WHERE id=:id";
			$stmt = $this->db->prepare($sql);
			$stmt->execute(array(':profil' => $newfilename, ':id' => $id));
		}
	}

	public function changeData($id, $nama, $username, $email, $telp, $address)
	{
		$sql = "UPDATE users SET nama=:nama, username=:username, email=:email, telp=:telp, address=:address WHERE id=:id";
		$stmt = $this->db->prepare($sql);
		$stmt->execute(array(':nama' => $nama, ':username' => $username, ':email' => $email, ':telp' => $telp, ':address' => $address, ':id' => $id));
		if (!$stmt) {
			return "Gagal";
		}else{
			return "Sukses";
		}
	}

	public function changePw($id, $password, $password1)
	{
		$select = "SELECT * FROM users WHERE id=:id";
		$stmt = $this->db->prepare($select);
		if ($stmt->db->execute(array(':id' => '$id'))) {
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			if (password_verify($password, $result['password'])) {
				$sql = "UPDATE users SET password=:password WHERE id=:id";
				$stmt2 = $this->db->prepare($sql);
				$stmt2->execute(array('password' => $password1, ':id' => $id));
				if (!$stmt2) {
					return "Gagal";
				}else{
					return "Sukses";
				}
			}else{
				return "PWGagal";
			}
		}else{
			return "DBGagal";
		}
	}

	public function loginAdmin($username, $password)
	{
		$select = "SELECT * FROM admin WHERE username=:username OR email=:email";
		$stmt = $this->db->prepare($select);
		if ($stmt->execute(array(':username' => $username, ':email' => $username))) {
		 	$result = $stmt->fetch(PDO::FETCH_ASSOC);
		 	if (password_verify($password, $result['password'])) {
		 		$_SESSION['admin'] = $result;
		 		return "Sukses";
		 	}else{
		 		return "Gagal";
		 	}
		 }else{
		 	return "Gagal";
		 } 
	}

	public function tambahAdmin($name, $username, $hashed, $email)
	{
		$sql = "INSERT INTO admin (nama, username, password, email) VALUES (:nama, :username, :password, :email)";
		$stmt = $this->db->prepare($sql);
		$stmt->execute(array(':nama' => $name, ':username' => $username, ':password' => $hashed, ':email' => $email));
		if (!$stmt) {
			return "Gagal";
		}else{
			return "Sukses";
		}
	}

	public function userList()
	{
		$select = "SELECT * FROM users";
		$stmt = $this->db->prepare($select);
		if ($stmt->execute()) {
			return $stmt;
		}
	}

	public function addprod($pp, $nama, $desk, $harga, $stok, $kategori)
	{
		// PP
		$namapp = $pp['name'];
		$loctmp = $pp['tmp_name'];

		$allowed = array('png', 'jpg', 'jpeg');
		$x = explode('.', $namapp);
		$eks = strtolower(end($x));
		$newfilename = mt_rand(1,99).$nama.'.'.$eks;

		if (in_array($eks, $allowed) === TRUE) {
			move_uploaded_file($loctmp, '../img/prod/'.$newfilename);
				$sql = "INSERT INTO produk (poto, namaprod, deskprod, hargabrg, jumlahbrg, kategori) VALUES (:poto, :namaprod, :deskprod, :hargabrg, :jumlahbrg, :kategori)";
				$stmt = $this->db->prepare($sql);
				$stmt->execute(array(':poto' => $newfilename, ':namaprod' => $nama, ':deskprod' => $desk, ':hargabrg' => $harga, ':jumlahbrg' => $stok, ':kategori' => $kategori));
				if (!$stmt) {
					return "Gagal";
				}else{
					return "Sukses";
				}
		}else{
			return "EKSGagal";
		}
	}

	public function produkList()
	{
		$select = "SELECT * FROM produk";
		$stmt = $this->db->prepare($select);
		if ($stmt->execute()) {
			return $stmt;
		}

	}

	public function kategoriList()
	{
		$select = "SELECT * FROM kategori";
		$stmt = $this->db->prepare($select);
		if ($stmt->execute()) {
			return $stmt;
		}
	}

	public function addCatg($kategori)
	{
		$sql = "INSERT INTO kategori(namaktg) VALUES (:nama)";
		$stmt = $this->db->prepare($sql);
		if ($stmt->execute(array(':nama' => $kategori))) {
			return "Sukses";
		}

	}

	public function addtocart($userID, $prodID, $name, $price, $qty, $note)
	{
		$cek = "SELECT * FROM cart WHERE userID=:user AND prodID=:prod";
		$push = $this->db->prepare($cek);
		$push->execute(array(':user' => $userID, ':prod' => $prodID));
		$numRows = $push->fetchColumn();
		while ($getData = $push->fetch(PDO::FETCH_ASSOC)) {
			$oldQty = $getData->qty;
		};
		$totalQty = $oldQty + $qty;
		if ($numRows > 0) {
			$query = "UPDATE cart SET qty=:qty WHERE userID=:user AND prodID=:prod";
			$stmt = $this->db->prepare($query);
			$stmt->execute(array(':qty' => $totalQty, ':user' => $userID, ':prod' => $prodID));
		}else{		
			$query = "INSERT INTO cart (userID, prodID, name, price, qty, note) VALUES (:user, :prod, :name, :price, :qty, :note)";
			$stmt = $this->db->prepare($query);
			$stmt->execute(array(':user' => $userID, ':prod' => $prodID, ':name' => $name, ':price' => $price, ':qty' => $qty, ':note' => $note));
			if (!$stmt) {
				return "Gagal";
			}else{
				return "Sukses";
			}
		}
	}

	public function showCart()
	{
		$query = "SELECT * FROM cart WHERE userID=:id";
		$stmt = $this->db->prepare($query);
		if ($stmt->execute(array(':id' => $_SESSION['user']['id']))) {
			return $stmt;
		}
	}

	public function cartTotal()
	{
		$query = "SELECT sum(price) AS priceSum FROM cart WHERE userID=:id";
		$stmt = $this->db->prepare($query);
		if ($stmt->execute(array(':id' => $_SESSION['user']['id']))) {
			return $stmt;
		}
	}

	public function countCart()
	{
		$query = "SELECT * FROM cart WHERE userID=:id";
		$stmt = $this->db->prepare($query);
		if ($stmt->execute(array(':id' => $_SESSION['user']['id']))) {
			$count = $stmt->rowCount();
			return $count;
		}

	}
}

 ?>