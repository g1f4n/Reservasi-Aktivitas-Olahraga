<?php 
session_start();
include '../fungsi/koneksi/koneksi.php';
if (isset($_POST['login'])) {
	$username = $_POST['user'];
	$password = md5($_POST['pass']);
	if (empty($username) || empty($password)) { ?>
		<script>alert('Inputan Tidak Boleh Kosong!!!');
		window.location.href = '../index.php#loginmember';
		</script><?php
	} else {
		$query = mysql_query("SELECT * FROM member WHERE email = '$username' AND password = '$password'") or die(mysql_error());
		$numrows =mysql_num_rows($query);
		if ($numrows == 1 ) {
			$fetch = mysql_fetch_array($query);
			extract($fetch);

			$_SESSION['email']    = $fetch['email'];
			$_SESSION['password'] = $fetch['password']; 
			$_SESSION['kodemember'] = $fetch['kodemember'];
			if (isset($_SESSION['email'])) {
				header("location:../user/halamanuser.php");
			}
		} else { ?>
			<script>alert('Email Atau Kata Sandi Salah!!!');
				window.location.href = '../index.php#loginmember';
			</script><?php
		}
	}
}
 ?>
 