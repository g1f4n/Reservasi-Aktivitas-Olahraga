<?php 

 ?>
<script>
	function validasiInput(form) {
		var harusHuruf = /^[a-zA-Z ]+$/;
		var pola_email = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

		if (form.nama.value == "" && form.username.value == "" && form.password.value == "") {
			alert('Harap melengkapi Data Yang Kosong');
			form.nama.focus();
			return false;
		} if (!harusHuruf.test(form.nama.value)) {
			alert('Harap Mengisi Nama Dengan Huruf');
			form.nama.focus();
			return false;
		} if (!pola_email.test(form.username.value)) {
			alert('Harap Mengisi Email Anda');
			form.username.focus();
			return false;
		} if (form.nama.value == "") {
			alert('Harap melengkapi Nama Anda');
			form.nama.focus();
			return false;
		} if (form.username.value == "") {
			alert('Harap melengkapi Email Anda');
			form.username.focus();
			return false;
		} if (form.password.value == "") {
			alert('Harap melengkapi Password Anda');
			form.password.focus();
			return false;
		} else {
			return true;
		}
	}
</script>
<h4>Data Diri</h4>
<form action="" method="POST" enctype="multipart/form-data" onsubmit="return validasiInput(this);">
<?php 
$kodeuser = @$_SESSION['kodeuser'];
$query = mysql_query("SELECT * FROM admin WHERE kodeuser = '$kodeuser'") or die(mysql_error());
$hasil = mysql_fetch_array($query);
 ?>
	<table>
		<tr>
			<td>Kode Pengguna</td>
			<td>:</td>
			<td><input type="text" name="kodeuser" value="<?php echo $hasil['kodeuser'] ?>" readonly></td>
		</tr>

		<tr>
			<td>Nama Lengkap</td>
			<td>:</td>
			<td><input type="text" name="nama" value="<?php echo $hasil['nama']; ?>"></td>
		</tr>

		<tr>
			<td>Nama Pengguna</td>
			<td>:</td>
			<td><input type="text" name="username" value="<?php echo $hasil['username']; ?>"></td>
		</tr>

		<tr>
			<td>Kata Sandi</td>
			<td>:</td>
			<td><input type="password" name="password" value="*****"></td>
		</tr>

		<tr>
			<td></td>
			<td></td>
			<td><input id="edit" type="submit" name="edit" value="Ubah" readonly></td>
		</tr>
	</table>

	<?php 
	$kodeuser = @$_POST['kodeuser'];
	$nama = @$_POST['nama'];
	$username = @$_POST['username'];
	$password = @$_POST['password'];
	$passwordlama = $hasil['password'];

	if (@$_POST['edit']) {
		if ($password == '*****') {
			mysql_query("UPDATE admin SET nama = '$nama', username = '$username', password = '$passwordlama' WHERE kodeuser = '$kodeuser'") or die(mysql_error());
			?><script>
				alert('Data Berhasil Di Ubah');
				window.location.href = 'halamanpetugas.php';
			</script><?php
		} else {
			mysql_query("UPDATE admin SET nama = '$nama', username = '$username', password = md5('$password') WHERE kodeuser = '$kodeuser'") or die(mysql_error());
			?><script>
				alert('Data Berhasil Di Ubah');
				window.location.href = 'halamanpetugas.php';
			</script><?php
		}
	}
	 ?>
</form>