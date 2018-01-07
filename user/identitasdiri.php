<script>
	
// validasi Kalau Inputan Kosong, Harus Angka, Minimal Karakter, email, upload foto
function cekData() {
	// Validasi Nama Harus Huruf
	var harusHuruf = /^[a-zA-Z ]+$/;
	// Validasi Nama Harus Huruf
	
	// Validasi Email harus ada karakter @ dan .
	var pola_email = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
	// Akhir Validasi Email harus ada karakter @ dan .

	// Validasi Nomor Telepon harus Angka
	var nomor_telepon = document.forms["daftar"]["telp"].value;
	var nomor = /^[0-9]+$/;
	// Akhir Validasi Nomor Telepon harus Angka

	// Validasi Gambar 
		// Gambar Yang Di izinkan Hanya format Jpg, Jpeg dan Png
		// var inputFile = document.getElementById('gambar');
		// var pathFile = inputFile.value;
		// var extensi = /(\.jpg | \.jpeg | \.png)$/i;
		// Akhir Gambar Yang Di izinkan Hanya format Jpg, Jpeg dan Png

		// Gambar Maksimal 2 MegaByte
		var fileSize = document.getElementById("gambar").files[0];
		// Akhir Gambar Maksimal 2 MegaByte
	// Akhir Validasi Gambar


	if (daftar.nama.value === "" && daftar.jk.value === "" && daftar.telp.value === "" && daftar.alamat.value === "" && daftar.email.value === "" && daftar.password.value === "") {
		alert('Harap Melengkapi Data Yang Masih Kosong!!!');
		daftar.nama.focus();
		return false;
	} if (daftar.nama.value === "") {
		alert('Inputan Nama Lengkap Tidak Boleh Kosong');
		daftar.nama.focus();
		return false;
	} if (!harusHuruf.test(daftar.nama.value)) {
		alert('Inputan Nama Lengkap Hanya Di Izinkan Huruf!!!');
		daftar.nama.focus();
		return false;
	} if (daftar.jk.value == '') {
			alert('Silahkan Pilih Jenis kelamin Terlebih Dahulu');
			return false;
	} if (nomor_telepon === "" || nomor_telepon === null) {
		alert("Inputan Nomor Telepon Tidak Boleh Kosong!!!");
		daftar.telp.focus();
		return false;
	} if (!nomor_telepon.match(nomor)) {
		alert("Inputan Nomor Telepon Hanya Di Izinkan Angka!!!");
		daftar.telp.focus();
		return false;
	} if (daftar.alamat.value === "") {
		alert("Inputan Alamat Tidak Boleh Kosong!!!");
		daftar.alamat.focus();
		return false;
	} if (daftar.email.value === "") {
		alert("Inputan Email Tidak Boleh Kosong!!!");
		daftar.email.focus();
		return false;
	} if (!pola_email.test(daftar.email.value)) {
			alert('Inputan Email Anda Salah Atau Kurang Lengkap, Contoh@gmail.com');
			daftar.email.focus();
			return false;
	} if (daftar.password.value === "") {
		alert("Inputan Kata Sandi Tidak Boleh Kosong!!!");
		daftar.password.focus();
		return false;
	//} if (!extensi.exec(pathFile)) {
		//alert(".jpeg, .jpg, .png Only Accepted");
		//return false;
	} if (fileSize.size > 2097152) {
		alert("Foto Yang Di Unggah Maksimal 2 MegaByte");
		return false;
	} else {
		return true;
	}
}
// Akhir validasi Kalau Inputan Kosong, Harus Angka, Minimal Karakter, email, upload foto
</script>
<form action="" id="daftar" method="POST" enctype="multipart/form-data" onsubmit=" return cekData();">
	<h4>IDENTITAS DIRI</<h4>
	<table class="tabel1">
	<?php 

		include '../fungsi/koneksi/koneksi.php';
		$username = @$_GET['username'];
		$sql      = mysql_query("SELECT * FROM member WHERE email = '$username'");
		$data = mysql_fetch_array($sql);
	 ?>
		<tr>
			<td><label for="noktp">Kode Anggota </label></td>
			<td><input type="text" name="noktp" id="noktp" value="<?php echo $data[0]; ?>" readonly></td><br>
		</tr>
		<tr>
			<td><label for="nama">Nama Lengkap </label></td>
			<td><input type="text" maxlength="40" name="nama" id="nama" value="<?php echo $data[1]; ?>"></td><br>
		</tr>
		<tr>
			<td><label for="jk">Jenis Kelamin </label></td>
			<td>
				<label><input class="jeniskelamin" type="radio" name="jk" value="<?php echo $data['jeniskelamin']; ?>" <?php if ($data['jeniskelamin'] == 'Laki-Laki') {echo "checked";} ?> style="height: auto;" /> Laki - Laki</label>
					<label><input class="jeniskelamin" type="radio" name="jk" value="<?php echo $data['jeniskelamin']; ?>" <?php if ($data['jeniskelamin'] == 'Perempuan') {echo "checked";} ?> style="height: auto;" /> Perempuan</label>
			</td><br>
		</tr>
		<tr>
			<td><label for="telp">Nomor Telepon </label></td>
			<td><input type="text" maxlength="11" name="telp" id="telp" value="<?php echo $data['telp']; ?>"></td><br>
		</tr>
		<tr>
			<td><label for="alamat">Alamat </label></td>
			<td><textarea name="alamat" id="alamat" cols="22" rows="10"><?php echo $data['alamat']; ?></textarea></td><br>
		</tr>
		<tr>
			<td><label for="email">Email </label></td>
			<td><input type="text" maxlength="50" name="email" id="email" value="<?php echo $data['email']; ?>"></td><br>
		</tr>
		<tr>
			<td><label for="password">Kata Sandi </label></td>
			<td><input type="password" name="password" maxlength="40" id="password" value="*****"></td><br>
		</tr>
		<tr>
			<td><label for="gambar">Ubah Foto </label></td>
			<?php 
			if ($data['gambar'] == "") { ?>
				<td><img src="../gambar/foto/default.jpg"></td>
			<?php 
			} else {
			 ?>
			<td><img src="../gambar/foto/<?php echo $data['gambar']; ?>" alt="<?php echo $data['kodemember']; ?>"></td>
			<?php
			} ?>
		</tr>
		<tr>
			<td></td>
			<td><input style="border: none;" type="file" name="gambar" id="gambar" value="<?php echo $data['gambar']; ?>"></td><br>
		</tr>
		<tr>
			<td></td>
			<td class="gambar"><input class="edit" type="submit" name="edit" value="Ubah"></td>
		</tr>
	</table>
	<?php 
		$noktp       = @$_POST['noktp'];
		$nama        = @$_POST['nama'];
		$jk          = @$_POST['jk'];
		$telp        = @$_POST['telp'];
		$alamat      = @$_POST['alamat'];
		
		$sumber      = @$_FILES['gambar']['tmp_name'];
		$target      = '../gambar/foto/';
		$nama_gambar = @$_FILES['gambar']['name'];
		
		$username    = @$_POST['email'];
		$password    = @$_POST['password'];
		$passwordlama = $data['password'];

		$imageFileType = pathinfo($nama_gambar, PATHINFO_EXTENSION);	 

		if (@$_POST['edit']) {
			if ($nama_gambar == ""){ 
				mysql_query("UPDATE member SET namalengkap = '$nama', jeniskelamin = '$jk', telp = '$telp', alamat = '$alamat', email = '$username', password = '$passwordlama' WHERE kodemember='$noktp'") or die(mysql_error());
				?><script>alert('Data Berhasil Di Ubah');</script>
				<meta http-equiv="refresh" content="0; url=halamanuser.php?page=identitasdiri&username=<?php echo $data['email']; ?>"><?php
			} else if($imageFileType != 'jpg' && $imageFileType != 'jpeg' && $imageFileType != 'png') {
				?><script>
					alert('Foto yang diizinkan hanya ekstensi .jpg atau .png');
				</script><?php
			} else {
				$pindah = move_uploaded_file($sumber, $target.$nama_gambar);
				if ($pindah) {
					if ($password == '*****') {
						mysql_query("UPDATE member SET namalengkap = '$nama', jeniskelamin = '$jk', telp = '$telp', alamat = '$alamat', gambar = '$nama_gambar', email = '$username', password = '$passwordlama' WHERE kodemember='$noktp'") or die(mysql_error());
						?><script>alert('Data Berhasil Di Ubah');</script>
						<meta http-equiv="refresh" content="0; url=halamanuser.php?page=identitasdiri&username=<?php echo $data['email']; ?>"><?php
					} else {
						mysql_query("UPDATE member SET namalengkap = '$nama', jeniskelamin = '$jk', telp = '$telp', alamat = '$alamat', gambar = '$nama_gambar', email = '$username', password = md5('$password') WHERE kodemember='$noktp'") or die(mysql_error());
						?><script>alert('Data Berhasil Di Ubah');</script>
						<meta http-equiv="refresh" content="0; url=halamanuser.php?page=identitasdiri&username=<?php echo $data['email']; ?>"><?php
					}
				} else {
					?>
					<script>alert('Gambar Gagal Di Upload');
					window.location.href = '?page=identitasdiri';
					</script><?php
				}
			}
		}
	?>
</form>