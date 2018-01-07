<script>
	function validasiInput(form) {
		var namaLengkap = /^[a-zA-Z ]+$/;
		if (form.nama.value == '' && form.username.value == '' && form.password.value == '') {
			alert('Inputan Tidak Boleh Kosong');
			form.nama.focus();
			return false;
		} if (!namaLengkap.test(form.nama.value)) {
			alert('Inputan Nama Lengkap Hanya Di Izinkan Huruf');
			form.nama.focus();
			return false;
		} if (form.nama.value == '') {
			alert('Inputan Nama Lengkap Tidak Boleh Kosong');
			form.nama.focus();
			return false;
		} if (form.username.value == '') {
			alert('Inputan Nama Pengguna Tidak Boleh Kosong');
			form.username.focus();
			return false;
		} if (form.password.value == '') {
			alert('Inputan Kata Sandi Tidak Boleh Kosong');
			form.password.focus();
			return false;
		} else {
			return true;
		}
	}
</script>

<h4>Ubah Data Petugas</h4>
<form action="" method="POST" enctype="multipart/form-data" onsubmit="return validasiInput(this);">
	<table>
	<?php 
	$kodeuser = @$_GET['kodeuser'];
	$ubahdata = mysql_query("SELECT * FROM admin WHERE kodeuser = '$kodeuser'") or die(mysql_error());
	$hasil = mysql_fetch_array($ubahdata);
	 ?>
		<tr>
			<td>Kode Pengguna</td>
			<td>:</td>
			<td><input type="text" name="kodeuser" value="<?php echo $hasil['kodeuser']; ?>" readonly></td>
		</tr>

		<tr>
			<td>Nama Lengkap</td>
			<td>:</td>
			<td><input type="text" name="nama" maxlength="40" value="<?php echo $hasil['nama']; ?>"></td>
		</tr>

		<tr>
			<td>Nama Pengguna</td>
			<td>:</td>
			<td><input type="text" name="username" maxlength="10" value="<?php echo $hasil['username']; ?>"></td>
		</tr>

		<tr>
			<td>Kata Sandi</td>
			<td>:</td>
			<td><input type="password" maxlength="40" name="password" value="*****"></td>
		</tr>

		<tr>
			<td>level</td>
			<td>:</td>
			<td>
				<select name="level" id="level">
					<option value="administrator" <?php if($hasil['level'] == 'administrator') { echo 'selected'; } ?>>Administrator</option>
					<option value="kasir" <?php if($hasil['level'] == 'kasir') { echo 'selected'; } ?>>Kasir</option>
				</select>
			</td>
		</tr>

		<tr>
			<td></td>
			<td></td>
			<td><input id="edit" type="submit" name="edit" value="Ubah" readonly></td>
		</tr>
	</table>
	<?php 
	$query1 = mysql_query("SELECT * FROM admin WHERE kodeuser = '$kodeuser'") or die(mysql_error());

	$kodeuser = @$_POST['kodeuser'];
	$nama     = @$_POST['nama'];
	$username = @$_POST['username'];
	$password = @$_POST['password'];
	$passwordlama = $hasil['password'];
	$level    = @$_POST['level'];
	
	if (@$_POST['edit']) {
		if ($password == '*****') {
			mysql_query("UPDATE admin SET nama = '$nama', username = '$username', password = '$passwordlama' WHERE kodeuser = '$kodeuser'") or die(mysql_error());
			?><script>
				alert('Data Berhasil Di Ubah');
				window.location.href = "halamanadministrator.php?page=lihatdatapegtugas";
			</script><?php 
		} else {
			mysql_query("UPDATE admin SET nama = '$nama', username = '$username', password = md5('$password') WHERE kodeuser = '$kodeuser'") or die(mysql_error());
			?><script>
				alert('Data Berhasil Di Ubah');
				window.location.href = "halamanadministrator.php?page=lihatdatapegtugas";
			</script><?php 
		}
	}
	 ?>
</form>