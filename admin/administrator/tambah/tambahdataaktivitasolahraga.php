<h4>Tambah Data Aktivitas Olahraga</h4>

<!-- Validasi Input -->
<script>
	function validasiInput(form) {
		var angka = /^[0-9]+:[0-9]+:[0-9]+$/;
		var namaLengkap = /^[a-zA-Z ]+$/;
		var Harga = document.forms["daftar"]["harga"].value;
		var harga = /^[0-9]+$/;
		var fileSize = document.getElementById("gambar").files[0];
		if (form.kodeolahraga.value == '' && form.namaolahraga.value == '' && form.harga.value == '' && form.kodeinstruktur.value == '') {
			alert('Inputan Tidak Boleh Kosong');
			form.kodeolahraga.focus();
			return false;
		} if (!namaLengkap.test(form.kodeolahraga.value)) {
			alert('Inputan Kode Olahraga Hanya Di Izinkan Huruf');
			form.kodeolahraga.focus();
			return false;
		} if (form.kodeolahraga.value == '') {
			alert('Inputan Kode Olahraga Tidak Boleh Kosong');
			form.kodeolahraga.focus();
			return false;
		} if (form.namaolahraga.value == '') {
			alert('Inputan Aktivitas Olahraga Tidak Boleh Kosong');
			form.namaolahraga.focus();
			return false;
		} if (!namaLengkap.test(form.namaolahraga.value)) {
			alert('Inputan Aktivitas Olahraga Hanya Di Izinkan Huruf');
			form.namaolahraga.focus();
			return false;
		} if (form.namaolahraga.value == '') {
			alert('Inputan Aktivitas Olahraga Tidak Boleh Kosong');
			form.namaolahraga.focus();
			return false;
		} if (form.harga.value == '') {
			alert('Inputan Harga Tidak Boleh Kosong');
			form.harga.focus();
			return false;
		} if (!Harga.match(harga)) {
			alert('Inputan Harga Hanya Di Izinkan Angka');
			form.harga.focus();
			return false;
		} if (form.waktu.value == '') {
			alert('Inputan Waktu Mulai Tidak Boleh Kosong');
			form.waktu.focus();
			return false;
		} if(!angka.test(form.waktu.value)) {
			alert('Harap Menginput Dengan Benar Contoh 12:00:00');
			form.waktu.focus();
			return false;
		} if (form.waktu2.value == '') {
			alert('Inputan Waktu Selesai Tidak Boleh Kosong');
			form.waktu2.focus();
			return false;
		} if(!angka.test(form.waktu2.value)) {
			alert('Harap Menginput Dengan Benar Contoh 12:00:00');
			form.waktu2.focus();
			return false;
		} if (form.kodeinstruktur.value == '') {
			alert('Inputan Nama Instruktur Tidak Boleh Kosong');
			form.kodeinstruktur.focus();
			return false;
		}if (form.gambar.value == "") {
			alert('Anda Belum Memilih Gambar');
			form.gambar.focus();
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
<form action="" id="daftar" method="POST" enctype="multipart/form-data" onsubmit="return validasiInput(this);">
	<table>
		<tr>
			<td>Kode Olahraga</td>
			<td>:</td>
			<td><input type="text" name="kodeolahraga" id="kodeolahraga" maxlength="4"></td>
		</tr>

		<tr>
			<td>Aktivitas Olahraga</td>
			<td>:</td>
			<td><input type="text" name="namaolahraga" id="namaolahraga" maxlength="20"></td>
		</tr>

		<tr>
			<td>Harga</td>
			<td>:</td>
			<td><input type="text" name="harga" id="harga"></td>
		</tr>

		<tr>
			<td>Waktu Mulai</td>
			<td>:</td>
			<td><input type="text" name="waktu" id="Waktu"></td>
		</tr>

		<tr>
			<td>Waktu Selesai</td>
			<td>:</td>
			<td><input type="text" name="waktu2" id="waktu2"></td>
		</tr>

		<tr>
			<td>Nama Instruktur</td>
			<td>:</td>
			<td>
				<select name="kodeinstruktur" id="kodeinstruktur">
					<option value="">Pilih Instruktur</option>
					<?php 
					$data = mysql_query("SELECT * FROM instruktur") or die(mysql_error());
					while ($hasil = mysql_fetch_array($data)) { ?>
						<option value="<?php echo $hasil['kodeinstruktur']; ?>"><?php echo $hasil['namalengkap']; ?></option>
					<?php
					}
					 ?>
				</select>
			</td>
		</tr>

		<tr>
			<td>Fasilitas</td>
			<td>:</td>
			<td><textarea name="fasilitas" id="fasilitas" cols="30" rows="10"></textarea></td>
		</tr>

		<tr>
			<td>Foto</td>
			<td>:</td>
			<td><input style="border: none;" type="file" name="gambar" id="gambar"></td>
		</tr>

		<tr>
			<td></td>
			<td></td>
			<td><input id="edit" type="submit" name="tambah" value="Tambah"></td>
		</tr>
	</table>
<!-- Akhir Kerangka Body -->

<!-- Fungsi Simpan -->
<?php 
$kodeolahraga   = @$_POST['kodeolahraga'];
$namaolahraga   = @$_POST['namaolahraga'];
$harga          = @$_POST['harga'];
$waktu          = @$_POST['waktu'];
$waktu2         = @$_POST['waktu2'];
$kodeinstruktur = @$_POST['kodeinstruktur'];
$fasilitas      = @$_POST['fasilitas'];

$sumber         = @$_FILES['gambar']['tmp_name'];
$target         = '../../gambar/desainweb/';
$nama_gambar    = @$_FILES['gambar']['name'];
$imageFileType  = pathinfo($nama_gambar, PATHINFO_EXTENSION);

$sql            = mysql_query("SELECT * FROM jenisolahraga WHERE kodeolahraga = '$kodeolahraga'") or die(mysql_error());
$cek            = mysql_num_rows($sql);
$data           = mysql_fetch_array($sql);

if (@$_POST['tambah']) {
	if ($cek == 1) {
		?><script>
		alert('Aktivitas Olahraga Sudah Ada');
		window.location.href='halamanadministrator.php?page=tambahdataaktivitasolahraga';
		</script><?php  
	} else if ($imageFileType != 'jpg' && $imageFileType != 'jpeg' && $imageFileType != 'png') { ?>
		<script>
			alert('Maaf Hanya dengan ekstensi .jpg atau .png');
			window.location.href ='halamanadministrator.php?page=tambahdataaktivitasolahraga';
		</script>
	<?php
	} else($pindah = move_uploaded_file($sumber, $target.$nama_gambar)); {
		if ($pindah) {
			mysql_query("INSERT INTO jenisolahraga VALUES('$kodeolahraga', '$namaolahraga', '$harga', '$waktu' , '$waktu2' , '$nama_gambar', '$kodeinstruktur', '$fasilitas')") or die(mysql_error());
			?><script>
				alert('Data Berhasil Disimpan');
				window.location.href='halamanadministrator.php?page=lihatdataaktivitasolahraga';
			</script><?php
		} else {
			?><script>
				alert('Gambar Gagal Upload');
				window.location.href='halamanadministrator.php?page=tambahdataaktivitasolahraga';
			</script><?php
		} 
	}
}
 ?>
<!-- Akhir Fungsi Simpan -->
</form>