<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Reservasi Aktivitas Anda</title>
	
	<!-- Memanggil File CSS -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
	<link href="gambar/desainweb/favicon.ico" rel="shortcut icon">
	<link rel="stylesheet" href="js/jquery_ui.custom/jquery-ui.css">
	<!-- Akhir Memanggil File CSS -->

	<!-- Memanggil File JavaScript & JQuery -->
	<script src="js/script.js"></script>
	<script src="js/script2.js"></script>
	<script src="js/jquery-2.1.4.js"></script>
	<script src="js/jquery_ui.custom/jquery-ui.js"></script>
	<!-- Akhir Memanggil File JavaScript & JQuery -->
</head>
<body>
	<!-- NavBar -->
	<div class="navbar cf">
		<ul class="cf" id="right">
			<li class="brand"><a href="index.php"><i class="fa fa-home"></i> BrandSports</a></li>
			<li><a href="#loginmember"><i class="fa fa-sign-in" title="Masuk"> Masuk</i></a></li>
			<li><a href="?page=registration"><i class="fa fa-user-plus" title="Dafata Anggota"> Daftar Anggota</i></a></li>
			<li style="margin-left: 500px;"><a href="?page=aboutus"><i class="fa fa-users" title="Tentang Kami"></i> Tentang Kami</a></li>
		</ul>
		<div class="slideshow-container">

		<?php 
		include 'fungsi/koneksi/koneksi.php';
		$query = mysql_query("SELECT * FROM gallery");
		while ($data = mysql_fetch_array($query)) { ?>
		<div class="mySlides fade">
			<div class="numbertext">1 / 3</div>
			<img src="gambar/desainweb/<?php echo $data['slide']; ?>" style="width:100%; height: 400px;">
			<div class="text"><?php echo $data['kodegallery']; ?></div>
		</div>
		<?php
		}
		 ?>


		</div>
		<br>
	</div>

	<div style="text-align:center; background-color: #c1c1c1;">
		<span class="dot"></span> 
		<span class="dot"></span> 
		<span class="dot"></span> 
	</div>

	<script>
		var slideIndex = 0;
		showSlides();

		function showSlides() {
		var i;
		var slides = document.getElementsByClassName("mySlides");
		var dots = document.getElementsByClassName("dot");
		for (i = 0; i < slides.length; i++) {
		   slides[i].style.display = "none";  
		}
		slideIndex++;
		if (slideIndex> slides.length) {slideIndex = 1}    
		for (i = 0; i < dots.length; i++) {
		    dots[i].className = dots[i].className.replace(" active", "");
		}
		slides[slideIndex-1].style.display = "block";  
		dots[slideIndex-1].className += " active";
		setTimeout(showSlides, 2000); // Change image every 2 seconds
		}
	</script>
	<!-- Akhir NavBar -->

	<!-- Content  -->
	<div class="content-utama">
	<?php 
	include 'fungsi/koneksi/koneksi.php';
	$page = @$_GET['page'];
	if ($page === 'aboutus') {
		include 'tampilanindex/tentangkami.php';
	} else if ($page === 'registration') {
		include 'tampilanindex/daftar.php';
	} else if ($page === 'coach') {
		include 'tampilanindex/tampilinstruktur.php';
	} else if ($page === 'activity') {
		include 'tampilanindex/aktivitas.php';
	} else if ($page === 'pesanpertemuan') {
		include 'tampilanindex/pesanpertemuan.php';
	} else if ($page === 'gallery') {
		include 'tampilanindex/gallery.php';
	} else {
	 ?>
	 </div>
	<!-- Akhir Content  -->

	<!-- Fitur - Fitur -->
	<div class="fitur cf">
		<div class="fitur1">
			<h2><i class="fa fa-user">  Instruktur</i></h2>
			<p>Dilatih Dengan Instruktur Profesional Dan Berpengalaman</p>
			<button onclick="window.location.href = '?page=coach'" class="btn btn-primary">Lihat Instruktur</button>
		</div>
		<div class="fitur2">
			<h2><i class="fa fa-calendar-check-o">  Aktivitas Olahraga</i></h2>
			<p>Terdapat Banyak Aktivitas Olahraga Tersedia</p>
			<button onclick="window.location.href = '?page=activity'" class="btn btn-primary">Lihat Aktivitas Olahraga</button>
		</div>
		<div class="fitur3">
			<h2><i class="fa fa-camera">  Galeri Foto</i></h2>
			<p>Klik Untuk Melihat Galeri Foto</p><br>
			<button onclick="window.location.href = '?page=gallery'" class="btn btn-primary">Galeri Foto</button>
		</div>
	</div>
	<?php } ?>
	<!-- Akhir Fitur - Fitur -->

	<!-- Validasi -->
	<script>
		function validasilogin(form) {
			var polaEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
			if (form.user.value == "" && form.pass.value == "") {
				alert('Inputan Tidak Boleh Kosong');
				form.user.focus();
				return false;
			} if (form.user.value == "") {
				alert('Inputan Email Tidak Boleh Kosong');
				form.user.focus();
				return false;
			} if (!polaEmail.test(form.user.value)) {
				alert('Inputan Email Anda Salah, Contoh@gmail.com');
				form.user.focus();
				return false;
			} if (form.pass.value == "") {
				alert('Inputan Kata Sandi Tidak Boleh Kosong');
				form.pass.focus();
				return false;
			} else {
				return true;
			}
		}
	</script>
	<!-- Akhir Validasi -->

	<!-- Login Member -->
	<div class="overlay" id="loginmember">
		<div class="login cf">
			<a href="" class="close">X</a>
			<form action="aksi/proseslogin.php" method="POST" onsubmit="return validasilogin(this);">
				<table>
					<h4>Brand Sports</h4>
					<h6><i class="fa fa-unlock-alt"></i> Masuk Anggota</h6>
					<hr>
					<tr>
						<td>Email</td>
						<td>:</td>
						<td><input type="text" maxlength="50" name="user" placeholder="Email Anda"></td>
					</tr>
					<tr>
						<td>Kata Sandi</td>
						<td>:</td>
						<td><input type="password" maxlength="40" name="pass" placeholder="Kata Sandi Anda"></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td><input class="btn-send2" type="submit" name="login" value="Masuk"></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
	<!-- Login Akhir Login Member -->

	<!-- Contact -->
	<div class="contact">
		<h4>Hubungi Kami</h4>
		<h4><a href=""><i class="fa fa-whatsapp"></i>  08996665237</a></h4>
		<h4><i class="fa fa-envelope-o"> muhamadhusain1996@gmail.com</i></h4>
		<h4><i class="fa fa-"></i></h4>
	</div>
	<!-- Akhir Contact -->

	<!-- Footer -->
	<div class="footer">
		<p>BrandSports</p>
	</div>
	<!-- Akhir Footer -->
</body>
</html>