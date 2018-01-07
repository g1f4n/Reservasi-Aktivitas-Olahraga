<?php 

// session_start();
// include '../koneksi/koneksi.php';
// if (!isset($_SESSION['email'])) {
// 	header("location:../index.php#loginmember");
// } else {	
 ?>


<!DOCTYPE html>
<html lang="en" id="beranda">
<head>
	<meta charset="UTF-8">
	<title>BrandSports</title>
	<link rel="stylesheet" href="../css/style2.css">
</head>
<body>
	
		<!-- Navigasi -->
		<nav class="topbar cf fixed">
			<div class="brand">
				<a href="halamanuser.php">Sinergi Fitnes</a>
				
			</div>

			<div class="menu">
				<ul>
					<li><a href="logout.php">Logout</a></li>
					<li><a href="?page=identitasdiri&username=<?php echo $data['email']; ?>">Identitas Diri</a></li>
					<li><a href="?page=lihataktivitas">Lihat Ativitas</a></li>
					<li><a href="?page=aktivitasolahraga">Aktivitas Olahraga</a></li>
				</ul>
			</div>
		</nav>
		<!-- Akhir Navigasi  -->

		<!-- Bagian Utama -->
		<?php 
		$member_login = @$_SESSION['email'];
		$sql = mysql_query("SELECT * FROM member WHERE email = '$member_login'") or die(mysql_error());
		$data = mysql_fetch_array($sql);

		 ?>
		<div class="utama cf">
			<div class="sidebar">
				<img src="../gambar/<?php echo $data['gambar']; ?>" alt="<?php echo $data['kodemember']; ?>">
				<h4>Hi <?php echo $data['namalengkap']; ?></h4>
				<hr>
				
				
			</div>
			<div class="main">

				<?php 
				$page = @$_GET['page'];
				if ($page == 'lihataktivitas') {
					include 'lihataktivitas.php';
				} elseif ($page == 'identitasdiri') {
					include 'identitasdiri.php';
				} elseif ($page == 'pesan') {
					include 'pemesanan.php';
				} elseif ($page == 'aktivitasolahraga') {
					include 'bookingaktivitas.php';
				} elseif ($page == 'pemesanan') {
					include 'pemesanan.php';
				} else {
					?><h1>SELAMAT DATANG <em><?php echo $data['namalengkap']; ?></em></h1><?php
				} 
				 
				 ?>
				
			</div>
		</div>
		<!-- Akhir Bagian Utama -->

		<!-- Bagian Kaki -->
		<div class="kaki">
			<p>&copy; Copyright 2017</p>
		</div>
		<!-- Akhir Bagian Kaki -->

		<!-- Script Javascript -->
		<script src="../js/jquery-3.1.1.min.js"></script>
		<script src="../js/script.js"></script>
		<script src="../js/jquery.easing.1.3.js"></script>
		<!-- Akhir Script Javascript -->
<?php //} ?>	
</body>
</html>