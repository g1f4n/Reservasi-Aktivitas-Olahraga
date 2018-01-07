<?php 

session_start();
include '../fungsi/koneksi/koneksi.php';
if (!isset($_SESSION['kodemember'])) {
	header("location:../index.php#loginmember");
} else {	
 ?>


<!DOCTYPE html>
<html lang="en" id="beranda">
<head>
	<meta charset="UTF-8">
	<title>Reservation Your Activity</title>
	<link rel="stylesheet" href="../css/style2.css">
	<link rel="shortcut icon" href="../gambar/desainweb/favicon.ico">
	<link rel="stylesheet" href="../css/font-awesome/css/font-awesome.css">
	<link rel="stylesheet" href="../js/jquery_ui.custom/jquery-ui.css">
	<script src="../js/jquery-2.1.4.js" type="text/javascript"></script>
	<!-- <script src="../js/script.js" type="text/javascript"></script> -->
	<script src="../js/jquery_ui.custom/jquery-ui.js" type="text/javascript"></script>
</head>
<body>
	
		<!-- Navigasi -->
		<nav class="topbar cf fixed">
			<div class="brand">
				<a href="halamanuser.php">BrandSports</a>
			</div>

			<div class="menu">
				<ul>
					<li><a href="logout.php">Keluar</a></li>
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
				<?php 
				if ($data['gambar'] == "") { ?>
					<img src="../gambar/foto/default.jpg" alt=""><?php
				} else { ?>
				<img src="../gambar/foto/<?php echo $data['gambar']; ?>" alt="<?php echo $data['kodemember']; ?>"><?php
				}
				 ?>
				<h4>Hai <?php echo $data['namalengkap']; ?></h4>
				<hr>
				<ul>
					<li><a href="?page=beranda">Beranda</a></li>
					<li><a href="?page=identitasdiri&username=<?php echo $data['email']; ?>">Identitas Diri</a></li>
					<li><a href="?page=lihataktivitas">Jadwal Ativitas</a></li>
					<li><a href="?page=aktivitasolahraga">Pesan Aktivitas</a></li>
					<li><a href="?page=konfirmasibooking">Konfirmasi Pesanan</a></li>
					<li><a href="?page=lihataktivitas">Pembatalan Pesanan</a></li>

				</ul>
				
			</div>
			<div class="main">

				<?php 
				$page = @$_GET['page'];
				if ($page == 'lihataktivitas') {
					include 'lihataktivitas.php';
				} elseif ($page == 'identitasdiri') {
					include 'identitasdiri.php';
				} elseif ($page == 'konfirmasibooking') {
					include 'konfirmasibooking.php';
				} elseif ($page == 'konfirmasiaktivitas') {
					include 'konfirmasiaktivitas.php';
				} elseif ($page == 'pesan') {
					include 'pemesanan.php';
				} elseif ($page == 'aktivitasolahraga') {
					include 'bookingaktivitas.php';
				} elseif ($page == 'jadwalulang') {
					include 'jadwalulang.php';
				} elseif ($page == 'pemesanan') {
					include 'pemesanan.php';
				} else {
					include 'beranda.php';
				} 
				 
				 ?>
				
			</div>
		</div>
		<!-- Akhir Bagian Utama -->

		<!-- Bagian Kaki -->
		<div class="kaki">
			<p>BrandSports</p>
		</div>
		<!-- Akhir Bagian Kaki -->

		<!-- Script Javascript -->
		<script src="../js/jquery-3.1.1.min.js"></script>
		<script src="../js/script.js"></script>
		<script src="../js/jquery.easing.1.3.js"></script>
		<!-- Akhir Script Javascript -->
<?php } ?>	
</body>
</html>