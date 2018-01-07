<script>
	function validasiInput2(form) {

		var namaLengkap = /^[a-zA-Z ]+$/;
		var pola_email = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
		var nomor_telepon = document.forms["instruktur"]["telp"].value;
		var nomor = /^[0-9]+$/;
		var fileSize = document.getElementById("gambar").files[0];

		if (form.kodeinstruktur.value == '' && form.nama.value == '' && form.jk.value == '' && form.telp.value == '' && form.alamat.value == '' &&  form.email.value == '') {
			alert('Inputan Tidak Boleh Kosong');
			form.kodeinstruktur.focus();
			return false;
		} if (form.kodeinstruktur.value == '') {
			alert('Inputan Kode Instruktur Tidak Boleh Kosong');
			form.kodeinstruktur.focus();
			return false;
		} if (!namaLengkap.test(form.kodeinstruktur.value)) {
			alert('Inputan Kode Instruktur Hanya Di Izinkan Huruf');
			form.kodeinstruktur.focus();
			return false;
		} if (form.nama.value == '') {
			alert('Inputan Nama Lengkap Tidak Boleh Kosong');
			form.nama.focus();
			return false;
		} if (!namaLengkap.test(form.nama.value)) {
			alert('Inputan Nama Lengkap Hanya Di Izinkan Huruf');
			form.nama.focus();
			return false;
		} if (form.jk.value == '') {
			alert('Inputan Jenis Kelamin Tidak Boleh Kosong');
			form.jk.focus();
			return false;
		} if (form.telp.value == '') {
			alert('Inputan Nomor Telepon Tidak Boleh Kosong');
			form.telp.focus();
			return false;
		} if (!nomor_telepon.match(nomor)) {
			alert('Inputan Nomor Telepon Hanya Di Izinkan Angka');
			form.telp.focus();
			return false;
		} if (form.alamat.value == '') {
			alert('Inputan Alamat Tidak Boleh Kosong');
			form.alamat.focus();
			return false;
		} if (form.email.value == '') {
			alert('Inputan Email Tidak Boleh Kosong');
			form.email.focus();
			return false;
		} if (!pola_email.test(form.email.value)) {
			alert('Inputan Email Salah Atau Belum Lengkap, Tambahkan @ dan domain');
			form.email.focus();
			return false;
		} if (fileSize.size >= 2097152) {
			alert('Foto Maksimal 2 MegaByte');
			form.gambar.focus();
			return false;
		} else {
			return true;
		}
	}
</script>
<h4>Ubah Data Instruktur</h4>
<form action="" id="instruktur" method="POST" enctype="multipart/form-data" onsubmit="return validasiInput2(this);">
	<table>
	<?php 
	$kodeinstruktur = @$_GET['kodeinstruktur'];
	$ubahdata = mysql_query("SELECT * FROM instruktur WHERE kodeinstruktur = '$kodeinstruktur'") or die(mysql_error());
	$hasil = mysql_fetch_array($ubahdata);
	 ?>
		<tr>
			<td>Kode Instruktur</td>
			<td>:</td>
			<td><input type="text" name="kodeinstruktur" maxlength="3" value="<?php echo $hasil['kodeinstruktur']; ?>" readonly></td>
		</tr>

		<tr>
			<td>Nama Lengkap</td>
			<td>:</td>
			<td><input type="text" name="nama" maxlength="40" value="<?php echo $hasil['namalengkap']; ?>"></td>
		</tr>

		<tr>
			<td>Jenis Kelamin</td>
			<td>:</td>
			<td>
				<label><input class="jeniskelamin" type="radio" name="jk" value="<?php echo $hasil['jeniskelamin']; ?>" <?php if ($hasil['jeniskelamin'] == 'Laki-Laki') {echo "checked";} ?> style="height: auto;" /> Laki - Laki</label>
					<label><input class="jeniskelamin" type="radio" name="jk" value="<?php echo $hasil['jeniskelamin']; ?>" <?php if ($hasil['jeniskelamin'] == 'Perempuan') {echo "checked";} ?> style="height: auto;" /> Perempuan</label>
			</td>
		</tr>

		<tr>
			<td>Nomor Telepon</td>
			<td>:</td>
			<td><input type="text" name="telp" maxlength="12" value="<?php echo $hasil['telp']; ?>"></td>
		</tr>
		
		<tr>
			<td>Alamat</td>
			<td>:</td>
			<td><textarea name="alamat" id="alamat" cols="30" rows="10"><?php echo $hasil['alamat']; ?></textarea></td>
		</tr>

		<tr>
			<td>Email</td>
			<td>:</td>
			<td><input type="text" name="email" maxlength="50" value="<?php echo $hasil['email']; ?>"></td>
		</tr>

		<tr>
			<td>Foto</td>
			<td>:</td>
			<td><img style="width: 120px; height: 120px;" src="../../gambar/instruktur/<?php echo $hasil['gambar1']; ?>" alt="Tidak Ada Gambar"></td>
			<tr>
				<td></td>
				<td></td>
				<td><input type="file" name="gambar" id="gambar" value="<?php echo $hasil['gambar1']; ?>" style="border: none;"></td>
			</tr>
		</tr>

		<tr>
			<td></td>
			<td></td>
			<td><input id="edit" type="submit" name="edit" value="Ubah"></td>
		</tr>
	</table>
	<?php 
	$query1 = mysql_query("SELECT * FROM instruktur WHERE kodeinstruktur = '$kodeinstruktur'") or die(mysql_error());

	$kodeinstruktur = @$_POST['kodeinstruktur'];
	$nama           = @$_POST['nama'];
	$jk             = @$_POST['jk'];
	$telp           = @$_POST['telp'];
	$alamat         = @$_POST['alamat'];
	$email          = @$_POST['email'];
	
	$sumber         = @$_FILES['gambar']['tmp_name'];
	$target         = '../../gambar/instruktur/';
	$nama_gambar    = @$_FILES['gambar']['name'];
	$foto           = @$_POST['gambar'];
	$imageFileType = pathinfo($nama_gambar, PATHINFO_EXTENSION);
	
	if (@$_POST['edit']) {
		if ($nama_gambar == "") {
				mysql_query("UPDATE instruktur SET namalengkap = '$nama', jeniskelamin = '$jk', telp = '$telp', alamat = '$alamat', email = '$email' WHERE kodeinstruktur = '$kodeinstruktur'") or die(mysql_error());
				?><script>
				alert('Data Berhasil Di Ubah');
				window.location.href = "halamanadministrator.php?page=lihatdatainstruktur";
				</script><?php 
		} else if ($imageFileType != 'jpg' && $imageFileType != 'jpeg' && $imageFileType != 'png') {?>
			<script>
				alert('Foto Yang Diizinkan Hanya Ekstensi .jpg atau .png');
				window.location.href = "halamanadministrator.php?page=lihatdatainstruktur";
			</script>
		<?php
		} else {
			$pindah = move_uploaded_file($sumber, $target.$nama_gambar);
			if ($pindah) {
					mysql_query("UPDATE instruktur SET namalengkap = '$nama', jeniskelamin = '$jk', telp = '$telp', alamat = '$alamat', email = '$email', gambar1 = '$nama_gambar' WHERE kodeinstruktur = '$kodeinstruktur'") or die(mysql_error());
					?><script>
					alert('Data Berhasil Di Ubah');
					window.location.href = "halamanadministrator.php?page=lihatdatainstruktur";
					</script><?php 
			} else {
				?>
				<script>
					alert('Gambar Gagal Di Upload');
					window.location.href = 'halamanadministrator.php?page=editdatainstruktur';
				</script><?php
			}
		}
	}
	 ?>
</form>







