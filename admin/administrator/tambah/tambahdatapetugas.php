<h4>Tambah Data Petugas</h4>

<!-- Validasi Input -->
<script>
	function validasiInput(form) {
		var namaLengkap = /^[a-zA-Z ]+$/;
		var pola_email = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
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
<!-- Akhir Validasi Input -->

<!-- Kerangka Body -->
<form action="" method="POST" enctype="multipart/form-data" onsubmit="return validasiInput(this);">
	<table>
	<?php 
	$data = mysql_query("SELECT * FROM admin") or die(mysql_error());
	$hasil = mysql_fetch_array($data);

	$carikode = mysql_query("select max(kodeuser) from admin") or die (mysql_error());
	$datakode = mysql_fetch_array($carikode);
	if($datakode) {
		$nilaikode = substr($datakode[0], 1);
		$kode = (int) $nilaikode;
		$kode = $kode + 1;
		$hasilkode= "K".STR_PAD($kode, 2, "0", STR_PAD_LEFT);
	} else {
		$hasilkode = "not found";
	}
	 ?>
	 	<tr>
			<td>Kode Pengguna</td>
			<td>:</td>
			<td><input type="text" name="kodeuser" value="<?php echo $hasilkode; ?>"></td>
		</tr>
		<tr>
			<td>Nama Lengkap</td>
			<td>:</td>
			<td><input type="text" name="nama" maxlength="40" value=""></td>
		</tr>

		<tr>
			<td>Nama Pengguna</td>
			<td>:</td>
			<td><input type="text" name="username" maxlength="10" value=""></td>
		</tr>

		<tr>
			<td>Kata Sandi</td>
			<td>:</td>
			<td><input type="password" name="password" maxlength="40" value=""></td>
		</tr>

		<tr>
			<td>level</td>
			<td>:</td>
			<td>
				<select name="level" id="level">
					<option value="kasir" <?php if($hasil['level'] == 'kasir') { echo "selected"; } ?>>Kasir</option>
				</select>
			</td>
		</tr>

		<tr>
			<td></td>
			<td></td>
			<td><input id="edit" type="submit" name="tambah" value="Tambah"></td>
		</tr>
	</table>
<!-- Akhir Kerangka Body -->

<!-- Fungsi Simpan Data -->
	<?php 
	$kodeuser = @$_POST['kodeuser'];
	$nama     = @$_POST['nama'];
	$username = @$_POST['username'];
	$password = @$_POST['password'];
	$level    = @$_POST['level'];

	if (@$_POST['tambah']) {
		mysql_query("INSERT INTO admin VALUES ('$kodeuser', '$nama', '$username', md5('$password'), '$level')") or die(mysql_error());
		?>
		<script>
			alert('Data Berhasil Di Simpan');
			window.location.href = '?page=lihatdatapetugas';
		</script><?php
	}

	 ?>
<!-- Akhir Fungsi Simpan -->
</form>