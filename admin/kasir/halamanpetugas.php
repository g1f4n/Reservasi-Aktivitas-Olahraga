<?php 
	session_start();
	include '../../fungsi/koneksi/koneksi.php';
	if (!isset($_SESSION['username'])) {
		header('location:../index.php');
	} else {
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin Page</title>
	<link href="../../gambar/desainweb/favicon.ico" rel="shortcut icon">
	<link rel="stylesheet" href="../../css/style3.css">
	<link rel="stylesheet" href="../../js/jquery_ui.custom/jquery-ui.css">
	<link rel="stylesheet" href="../../css/font-awesome/css/font-awesome.min.css">
	<script src = "../../js/script2.js"></script>
	<script src = "../../js/script.js"></script>
	<script src = "../../js/jquery-2.1.4.js"></script>
	<script src = "../../js/jquery_ui.custom/jquery-ui.js"></script>
</head>
<body>
	<!-- Header -->
	<div class="header cf">
		<img src="../../gambar/desainweb/logo.png" alt="BrandSports" title="BrandSports">
		<h2>BrandSports</h2>
	</div>
	<!-- Akhir Header -->

	<!-- SideBar -->
	<div class="menubar">
		<li class="accordion"><a href="?page=beranda"><i class="fa fa-dashboard"></i> Beranda</a></li>
		<li class="accordion"><a href="?page=datadiri"><i class="fa fa-user"></i> Data Diri</a></li>

		<li class="accordion"><a href="#member"><i class="fa fa-users"></i> Data Anggota</a></li>
			<ul class="panel">
				<li><a href="?page=lihatdatamember"><i class="fa fa-search"> Lihat Data Anggota</i></a></li>
				<li><a href="?page=tambahdatamember"><i class="fa fa-user-plus"> Tambah Data Anggota</i></a></li>
			</ul>	

		<li class="accordion"><a href="#transaksi"><i class="fa fa-th"></i> Data Transaksi</a></li>
			<ul class="panel">
				<!-- <li><a href="?page=lihatdatabooking"><i class="fa fa-calendar-check-o"> Data Pemesanan</i></a></li> -->
				<li><a href="?page=lihatdatakonfirmasi"><i class="fa fa-check"> Data Konfirmasi</i></a></li>
			</ul>

		<li class="accordion"><a href="#laporan"><i class="fa fa-file"></i> Data Laporan</a></li>
			<ul class="panel">
				<li><a href="?page=laporanmember"><i class="fa fa-users"> Data Anggota</i></a></li>
				<li><a href="?page=laporanbooking"><i class="fa fa-calendar-check-o"> Data Pemesanan</i></a></li>
				<li><a href="?page=laporankonfrimasi"><i class="fa fa-check"> Data Konfirmasi</i></a></li>
			</ul>

		<li class="accordion"><a href="logout.php"><i class="fa fa-sign-out"> Keluar</i></a></li>
	</div>
	<!-- Akhir SideBar -->

	<!-- Content -->
	<div class="content">
	<?php 
	$page = @$_GET['page'];
	if ($page == 'datadiri') {
		include 'datadiri.php';

	// Data Member
	} else if ($page == 'lihatdatamember') {
		include 'datamember.php';
	} elseif ($page == 'editdatamember') {
		include 'edit/editdatamember.php';
	} elseif ($page == 'tambahdatamember') {
		include 'tambah/tambahdatamember.php';
	// Akhir Data Member

	// Data Booking
	}  else if ($page == 'lihatdatabooking') {
		include 'databooking.php';
	} elseif ($page == 'editdatabooking') {
		include 'edit/editdatabooking.php';
	} elseif ($page == 'tambahdatabooking') {
		include 'tambah/tambahdatabooking.php';
	// Akhir Data Booking

	// Data Konfirmasi
	}  else if ($page == 'lihatdatakonfirmasi') {
		include 'datakonfirmasi.php';
	} elseif ($page == 'editdatakonfirmasi') {
		include 'edit/editdatakonfirmasi.php';
	} elseif ($page == 'tambahdatakonfirmasi') {
		include 'tambah/tambahdatakonfirmasi.php';
	// Akhir Data Konfirmasi

	} else if ($page == 'ubahdatabooking') {
		include 'ubah/ubahdatabooking.php';
	
	// Laporan Keseluruhan
	} else if ($page == 'laporanmember') {
		include 'tampillaporan/tampildatamember.php';
	} else if ($page == 'laporanbooking') {
		include 'tampillaporan/tampildatabooking.php';
	} else if ($page == 'laporankonfrimasi') {
		include 'tampillaporan/tampildatakonfirmasi.php';
	// Akhir Laporan Keseluruhan

	// Laporan PerSolo
	} else if ($page == 'laporanmember-solo') {
		include 'tampillaporan-solo/laporanmember.php';
	} else if ($page == 'editgaleri') {
		include 'edit/editgaleri.php';
	} else {
		include 'beranda.php';
	}
	// Akhir Laporan PerSolo
	 ?>
	</div>
	<!-- Akhir Content -->

	<!-- Footer  -->
	<!-- <div class="footer">
		<p><i class="fa fa-copyright"></i> Copyright 2017</p>
	</div> -->
	<!-- Akhir Footer  -->


<script>
	var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].onclick = function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block"){
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    } 
  }
}
</script>
</body>
</html>
<?php } ?>