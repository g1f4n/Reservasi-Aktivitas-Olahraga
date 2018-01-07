<h4>Tambah Data Instruktur</h4>

<!-- Validasi Input -->
<script>
	function validasiInput2(form) {

		var namaLengkap = /^[a-zA-Z ]+$/;
		var pola_email = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
		var nomor_telepon = document.forms["instruktur"]["telp"].value;
		var nomor = /^[0-9]+$/;
		var fileSize = document.getElementById("gambar").files[0];

		if (form.Kodeinstruktur.value == '' && form.nama.value == '' && form.jk.value == '' && form.telp.value == '' && form.alamat.value == '' &&  form.email.value == '') {
			alert('Inputan Tidak Boleh Kosong');
			form.Kodeinstruktur.focus();
			return false;
		} if(form.Kodeinstruktur.value == '') {
			alert('Inputan Kode Instruktur Tidak Boleh Kosong');
			form.Kodeinstruktur.focus();
			return false;
		} if (!namaLengkap.test(form.Kodeinstruktur.value)) {
			alert('Inputan Kode Instruktur Hanya Di Izinkan Huruf');
			form.Kodeinstruktur.focus();
			return false;
		} if (form.nama.value == '') {
			alert('Inputan Nama Lengkap Tidak Boleh Kosong');
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
		} if (form.jk.value == '') {
			alert('Inputan Jenis Kelamin Tidak Boleh Kosong');
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
<!-- Akhir Validasi Input -->

<!-- Kerangka Body -->
<form id="instruktur" action="" method="POST" enctype="multipart/form-data" onsubmit="return validasiInput2(this);">
	<table>
		<tr>
			<td>Kode Instruktur</td>
			<td>:</td>
			<td><input type="text" name="Kodeinstruktur" maxlength="3" value=""></td>
		</tr>

		<tr>
			<td>Nama Lengkap</td>
			<td>:</td>
			<td><input type="text" maxlength="40" name="nama" value=""></td>
		</tr>

		<tr>
			<td>Jenis Kelamin</td>
			<td>:</td>
			<td>
				<label><input class="jeniskelamin" type="radio" name="jk" value="Laki-Laki" style="height: auto;" /> Laki - Laki</label>
				<label><input class="jeniskelamin" type="radio" name="jk" value="Perempuan" style="height: auto;" /> Perempuan</label>
			</td>
		</tr>

		<tr>
			<td>Nomor Telepon</td>
			<td>:</td>
			<td><input type="text" name="telp" maxlength="12" id="telp"></td>
		</tr>

		<tr>
			<td>Alamat</td>
			<td>:</td>
			<td><textarea name="alamat" id="alamat" cols="30" rows="10"></textarea></td>
		</tr>

		<tr>
			<td>Email</td>
			<td>:</td>
			<td><input type="text" maxlength="50" name="email"></td>
		</tr>

		<tr>
			<td>Foto</td>
			<td>:</td>
			<td><input type="file" name="gambar" id="gambar" style="border: none;"></td>
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
$Kodeinstruktur = @$_POST['Kodeinstruktur'];
$nama          = @$_POST['nama'];
$jk            = @$_POST['jk'];
$telp          = @$_POST['telp'];
$alamat        = @$_POST['alamat'];
$email         = @$_POST['email'];

$sumber        = @$_FILES['gambar']['tmp_name'];
$target        = '../../gambar/instruktur/';
$nama_gambar   = @$_FILES['gambar']['name'];
$imageFileType = pathinfo($nama_gambar, PATHINFO_EXTENSION);
$Foto          = '../../gambar/instruktur/img1.jpg';

$sql = mysql_query("SELECT * FROM instruktur WHERE email = '$email'") or die(mysql_error());
$cek = mysql_num_rows($sql);

if (@$_POST['tambah']) {
	if ($cek >= 1) {
		?><script>
			alert('Kode Instruktur Sudah Terdaftar');
			window.location.href = 'halamanadministrator.php?page=tambahdatainstruktur';
		</script><?php
	} else if ($pindah = move_uploaded_file($sumber, $target.$nama_gambar)); {
		if ($pindah) {
			if ($nama_gambar == '') {
				mysql_query("INSERT INTO instruktur VALUES ('$Kodeinstruktur', '$nama', '$jk', '$telp', '$alamat', '$email', '$Foto')") or die(mysql_error());
				?><script>
				alert('Data Berhasil Disimpan');
				window.location.href = 'halamanadministrator.php?page=lihatdatainstruktur';
				</script><?php
			} else if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg') {
				?><script>
					alert('Foto Yang Di Izinkan Hanya Ekstensi .jpg atau .png');
					window.location.href = 'halamanadministrator.php?page=tambahdatainstruktur';
				</script><?php
			} else {
				mysql_query("INSERT INTO instruktur VALUES ('$Kodeinstruktur', '$nama', '$jk', '$telp', '$alamat', '$email', '$nama_gambar')") or die(mysql_error());
				?><script>
				alert('Data Berhasil Disimpan');
				window.location.href = 'halamanadministrator.php?page=lihatdatainstruktur';
				</script><?php
			}
		} else {
			?><script>
				alert('Gambar Gagal Upload');
				window.location.href='halamanadministrator.php?page=tambahdatainstruktur';
			</script><?php
		}
	}
}

 ?>
<!-- Akhir Fungsi Simpan Data -->
</form>