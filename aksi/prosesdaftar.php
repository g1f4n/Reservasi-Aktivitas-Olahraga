<?php 
		include '../fungsi/koneksi/koneksi.php';

		$noktp       = @$_POST['kodemember'];
		$nama        = @$_POST['nama'];
		$jk          = @$_POST['jk'];
		$telp        = @$_POST['telp'];
		$alamat      = @$_POST['alamat'];
		$username    = @$_POST['email'];
		$password    = md5(@$_POST['password']);
		
		$sumber      = @$_FILES['gambar']['tmp_name'];
		$target      = '../gambar/foto/';
		$kosong      = "";
		$nama_gambar = @$_FILES['gambar']['name'];
		$imageFileType = pathinfo($nama_gambar, PATHINFO_EXTENSION);
		
		$daftar      = @$_POST['submit'];
		
		$sql         = mysql_query("SELECT * FROM member WHERE email = '$username'") or die(mysql_error());
		$cek         = mysql_num_rows($sql);
		$data        = mysql_fetch_array($sql);

		if ($daftar) {
			if ($cek >= 1) {
				?><script>
				alert('Alamat Email Sudah Ada');
				window.location.href='../index.php?#daftarmember';
				</script><?php  
			} else if ($nama_gambar == '') {
				mysql_query("INSERT INTO member VALUES('$noktp', '$nama', '$jk', '$telp', '$alamat', '$kosong' , '$username', '$password')") or die(mysql_error());
					?><script>
						alert('Data Berhasil Disimpan');
						window.location.href='../index.php?#loginmember';
					</script><?php
			} else if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
				?><script>
					alert('File Yang Di Izinkan Hanya .jpg, atau .png');
					window.location.href = '../index.php?#daftarmember'
				</script><?php
			} else($pindah = move_uploaded_file($sumber, $target.$nama_gambar)); {
				if ($pindah) {
					mysql_query("INSERT INTO member VALUES('$noktp', '$nama', '$jk', '$telp', '$alamat', '$nama_gambar' , '$username', '$password')") or die(mysql_error());
					?><script>
						alert('Data Berhasil Disimpan');
						window.location.href='../index.php?#loginmember';
					</script><?php
				} else {
					?><script>
						alert('Gambar Gagal Upload');
						window.location.href='../index.php?#daftarmember';
					</script><?php
				} 
			} 
		}
	?>