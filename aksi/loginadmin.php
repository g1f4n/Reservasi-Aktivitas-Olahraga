<?php 
session_start();
include '../fungsi/koneksi/koneksi.php';
$user = @$_POST['user'];
$pass = md5(@$_POST['pass'])	;
$masuk = @$_POST['masuk'];

if ($masuk) {
	if ($user == '' || $pass == '') {
		?><script>alert('Nama Pengguna dan Kata Sandi Tidak boleh Kosong!!!');
		window.location.href = '../admin';
		</script><?php
	} else {
		$sql = mysql_query("SELECT * FROM admin WHERE username = '$user' AND password = '$pass'") or die(mysql_error());
		$cek = mysql_num_rows($sql);
		$data = mysql_fetch_array($sql);
		if ($cek >= 1) {
			extract($data);


			if ($data['level'] == 'administrator') {
				@$_SESSION['administrator'] = $data['kodeuser'];
				@$_SESSION['nama'] = $data['nama'];
				header("location:../admin/administrator/halamanadministrator.php");
			} else if ($data['level'] == 'kasir') {
				@$_SESSION['kasir'] = $data['kodeuser'];
				@$_SESSION['kodeuser'] = $data['kodeuser'];
				@$_SESSION['nama'] = $data['nama'];
				@$_SESSION['username'] = $data['username'];
				@$_SESSION['password'] = $data['password'];
				@$_SESSION['level'] = $data['level'];
				header("location:../admin/kasir/halamanpetugas.php");
			}
		} else {
			?><script>alert('Nama Pengguna Atau Kata Sandi Salah!!!');
			window.location.href = '../admin';
			</script><?php
		}
	}
}

 ?>