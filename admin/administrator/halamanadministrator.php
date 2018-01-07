<?php 

session_start();
include '../../fungsi/koneksi/koneksi.php';
// if (!isset($_SESSION['username'])) {
// 	header("location:../index.php");
// } else {	
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Administrator Page</title>
	<link href="../../gambar/desainweb/favicon.ico" rel="shortcut icon">
	<link rel="stylesheet" href="../../css/style3.css">
	<link rel="stylesheet" href="../../css/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="../../js/jquery.timepicker.min.css">
	<script src="../../js/script.js"></script>
	<script src="../../js/jquery.timepicker.min.js"></script>
	<!-- <link rel="stylesheet" href="../../js/jqueryui/jquery-ui.min.css">
	<script src = "../../js/jqueryui/jquery-ui.min.js"></script>
	<script src = "../../js/jqueryui/jquery-2.1.4.js"></script>
	<script src = "../../js/jqueryui/jquery_ui.custom/jquery-ui.js"></script> -->
</head>
<body class="cf">
	<!-- Header -->
	<div class="header cf">
		<img src="../../gambar/desainweb/logo.png" alt="BrandSports" title="BrandSports">
		<h2>BrandSports</h2>
	</div>
	<!-- Akhir Header -->

	<!-- SideBar -->
	<div class="menubar cf">
		<li class="accordion"><a href="?page=beranda"><i class="fa fa-dashboard"></i> Beranda</a></li>

		<li class="accordion"><a href="#petugas"><i class="fa fa-users"></i> Data Petugas</a></li>
			<ul class="panel">
				<li><a href="?page=lihatdatapetugas"><i class="fa fa-search"> Lihat Data Petugas</i></a></li>
				<li><a href="?page=tambahdatapetugas"><i class="fa fa-user-plus"> Tambah Data Petugas</i></a></li>
			</ul>

		<li class="accordion"><a href="#instruktur"><i class="fa fa-users"></i> Data Instruktur</a></li>
			<ul class="panel">
				<li><a href="?page=lihatdatainstruktur"><i class="fa fa-search"> Lihat Data Instruktur</i></a></li>
				<li><a href="?page=tambahdatainstruktur"><i class="fa fa-user-plus"> Tambah Data Instruktur</i></a></li>
			</ul>

		<li class="accordion"><a href="#member"><i class="fa fa-users"></i> Data Anggota</a></li>
			<ul class="panel">
				<li><a href="?page=lihatdatamember"><i class="fa fa-search"> Lihat Data Anggota</i></a></li>
				<li><a href="?page=tambahdatamember"><i class="fa fa-user-plus"> Tambah Data Anggota</i></a></li>
			</ul>

		<li class="accordion"><a href="#aktivitasolahraga"><i class="fa fa-futbol-o"></i> Data Aktivitas Olahraga</a></li>
			<ul class="panel">
				<li><a href="?page=lihatdataaktivitasolahraga"><i class="fa fa-search"> Lihat Data Aktivitas Olahraga</i></a></li>
				<li><a href="?page=tambahdataaktivitasolahraga"><i class="fa fa-user-plus"> Tambah Data Aktivitas Olahraga</i></a></li>
			</ul>

		<li class="accordion"><a href="#laporan"><i class="fa fa-file"></i> Data Laporan</a></li>
			<ul class="panel">
				<li><a href="?page=laporanpetugas"><i class="fa fa-users"> Data Petugas</i></a></li>
				<li><a href="?page=laporaninstruktur"><i class="fa fa-users"> Data Instruktur</i></a></li>
				<li><a href="?page=laporanmember"><i class="fa fa-users"> Data Anggota</i></a></li>
				<li><a href="?page=laporanaktivitasolahraga"><i class="fa fa-futbol-o"> Data Aktivitas Olahraga</i></a></li>
				<li><a href="?page=laporanbooking"><i class="fa fa-calendar-check-o"> Data Pemesanan</i></a></li>
				<li><a href="?page=laporankonfirmasi"><i class="fa fa-check"> Data Konfirmasi</i></a></li>
			</ul>

		<li class="accordion"><a href="../index.php"><i class="fa fa-sign-out"> Keluar</i></a></li>
	</div>
	<!-- Akhir SideBar -->

	<!-- Content -->
	<div class="content cf">
		<?php 
		include '../../fungsi/koneksi/koneksi.php';	
		$page = @$_GET['page'];
		if ($page == 'datadiri') {
			include 'datadiri.php';
		
		// Data Petugas
		} elseif ($page == 'lihatdatapetugas') {
			include 'datapetugas.php';
		} elseif ($page == 'tambahdatapetugas') {
			include 'tambah/tambahdatapetugas.php';
		} elseif ($page == 'editdatapetugas') {
			include 'edit/editdatapetugas.php';
		// Akhir Data Petugas

		// Data Instruktur
		} elseif ($page == 'lihatdatainstruktur') {
			include 'datainstruktur.php';
		} elseif ($page == 'tambahdatainstruktur') {
			include 'tambah/tambahdatainstruktur.php';
		} elseif ($page == 'editdatainstruktur') {
			include 'edit/editdatainstruktur.php';
		// Akhir Data Instruktur

		// Data Member
		} elseif ($page == 'lihatdatamember') {
			include 'datamember.php';
		} elseif ($page == 'tambahdatamember') {
			include 'tambah/tambahdatamember.php';
		} elseif ($page == 'editdatamember') {
			include 'edit/editdatamember.php';
		// Akhir Data Member

		// Data Aktivitas Olahraga
		} elseif ($page == 'lihatdataaktivitasolahraga') {
			include 'dataaktivitasolahraga.php';
		} elseif ($page == 'tambahdataaktivitasolahraga') {
			include 'tambah/tambahdataaktivitasolahraga.php';
		} elseif ($page == 'editdataaktivitasolahraga') {
			include 'edit/editdataaktivitasolahraga.php';
		// Akhir Data Aktivitas Olahraga

		// Data Booking
		} elseif ($page == 'lihatdatabooking') {
			include 'databooking.php';
		} elseif ($page == 'tambahdatabooking') {
			include 'tambah/tambahdatabooking.php';
		} elseif ($page == 'ubahdatabooking') {
			include 'ubah/ubahdatabooking.php';
		} elseif ($page == 'editdatabooking') {
			include 'edit/editdatabooking.php';
		// Akhir Data Booking

		// Data Konfirmasi
		} elseif ($page == 'lihatdatakonfirmasi') {
			include 'datakonfirmasi.php';
		} elseif ($page == 'tambahdatakonfirmasi') {
			include 'tambahdatakonfirmasi.php';
		} elseif ($page == 'editdatakonfirmasi') {
			include 'editdatakonfirmasi.php';
		// Akhir Data Konfirmasi
		
		// Data Reschedule
		} elseif ($page == 'lihatdatareschedule') {
			include 'datareschedule.php';
		} elseif ($page == 'tambahdatareschedule') {
			include 'tambahdatareschedule.php';
		} elseif ($page == 'editdatareschedule') {
			include 'editdatareschedule.php';
		// Akhir Data Reschedule

		// Data Laporan
		} elseif ($page == 'laporanpetugas') {
			include 'tampillaporan/tampildataadmin.php';
		} elseif ($page == 'laporaninstruktur') {
			include 'tampillaporan/tampildatainstruktur.php';
		} elseif ($page == 'laporanmember') {
			include 'tampillaporan/tampildatamember.php';
		} elseif ($page == 'laporanaktivitasolahraga') {
			include 'tampillaporan/tampildataaktivitasolahraga.php';
		} elseif ($page == 'laporanbooking') {
			include 'tampillaporan/tampildatabooking.php';
		} elseif ($page == 'laporankonfirmasi') {
			include 'tampillaporan/tampildatakonfirmasi.php';
		// Akhir Data Laporan

		// Data Laporan Solo
		} else if ($page == 'laporan-data-petugas') {
			include '../../cetaklaporan/laporan-data-admin.php';
		
		// AkhirData Laporan Solo

		// Logout

		} else { 
			include 'beranda.php';
		?>
			
		<?php
		}
		 ?>
	</div>
	<!-- Akhir Content -->

	<!-- Footer  -->
	<!-- <div class="footer cf">
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
<?php // } ?>
</body>
</html>