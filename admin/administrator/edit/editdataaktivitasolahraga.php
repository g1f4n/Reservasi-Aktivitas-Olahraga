<h4>Ubah Data Aktivitas Olahraga</h4>


<script>
	function validasiInput(form) {
		var harga1 = document.forms["olahraga"]["harga"].value;
		var harga2 = /^[0-9]+$/;
		var huruf = /^[a-zA-Z]+$/;
		var valwaktu = /^[0-9]+:[0-9]+:[0-9]+$/;
		var fileSize = document.getElementById('gambar').files[0];

		if (form.kodeolahraga.value == '' && form.namaolahraga.value == '' && form.harga.value == '') {
			alert('Harap Melengkapi Data Yang Masih Kosong');
			form.namaolahraga.focus();
			return false;
		} if (form.kodeolahraga.value == '') {
			alert('Inputan Kode Olahraga Harus Di Isi');
			form.kodeolahraga.focus();
			return false;
		} if (!huruf.test(form.kodeolahraga.value)) {
			alert('Inputan Kode Olahraga Hanya Di Izinkan Huruf');
			form.kodeolahraga.focus();
			return false;
		} if (form.namaolahraga.value == '') {
			alert('Inputan Aktivitas Olahraga Harus Di Isi');
			form.namaolahraga.focus();
			return false;
		} if (!huruf.test(form.namaolahraga.value)) {
			alert('Inputan Aktivitas Olahraga Hanya Di Izinkan Huruf');
			form.namaolahraga.focus();
			return false;
		} if (form.waktu.value == "") {
			alert('Inputan Waktu Mulai Harus Di Isi');
			form.waktu.focus();
			return false;
		} if (!valwaktu.test(form.waktu.value)) {
			alert('Inputan Waktu Yang Anda Masukan salah, contoh : 12:00:00');
			form.waktu.focus();
			return false;
		} if (form.waktu2.value == "") {
			alert('Inputan Waktu Selesai Harus Di Isi');
			form.waktu2.focus();
			return false;
		} if (!valwaktu.test(form.waktu2.value)) {
			alert('Inputan Waktu Yang Anda Masukan salah, contoh : 12:00:00')
			form.waktu2.focus();
			return false;
		} if (form.harga.value == '') {
			alert('Inputan Harga Harus Di Isi');
			form.namaolahraga.focus();
			return false;
		} if (!harga1.match(harga2)) {
			alert('Inputan Harga Harus Angka');
			form.namaolahraga.focus();
			return false;
		} if (fileSize.size >= 2097152) {
			alert('Foto Maksimal 2 MB');
			form.gambar.focus();
			return false;
		} else {
			return true;
		}
	}
</script>


<form id="olahraga" action="" method="POST" enctype="multipart/form-data" onsubmit="return validasiInput(this);">
	<table>
	<?php 
	$kodeolahraga = @$_GET['kodeolahraga'];
	$ubahdata = mysql_query("SELECT * FROM jenisolahraga JOIN instruktur ON jenisolahraga.kodeinstruktur = instruktur.kodeinstruktur WHERE kodeolahraga = '$kodeolahraga'") or die(mysql_error());
	$hasil = mysql_fetch_array($ubahdata);
	 ?>
		<tr>
			<td>Kode Olahraga</td>
			<td>:</td>
			<td><input type="text" name="kodeolahraga" maxlength="4" value="<?php echo $hasil['kodeolahraga']; ?>" readonly></td>
		</tr>

		<tr>
			<td>Aktivitas Olahraga</td>
			<td>:</td>
			<td><input type="text" name="namaolahraga" maxlength="20" value="<?php echo $hasil['namaolahraga']; ?>" readonly></td>
		</tr>

		<tr>
			<td>Waktu Mulai</td>
			<td>:</td>
			<td><input type="text" name="waktu" value="<?php echo $hasil['waktu']; ?>"></td>
		</tr>

		<tr>
			<td>Waktu Selesai</td>
			<td>:</td>
			<td><input type="text" name="waktu2" value="<?php echo $hasil['waktu2']; ?>"></td>
		</tr>

		<tr>
			<td>Harga</td>
			<td>:</td>
			<td><input type="text" name="harga" value="<?php echo $hasil['harga']; ?>"></td>
		</tr>

		<tr>
			<td>Instruktur</td>
			<td>:</td>
			<td>
				<select name="kodeinstruktur" id="kodeinstruktur" disabled>
					<?php 
					$kodeinstruktur = mysql_query("SELECT * FROM instruktur ORDER BY namalengkap") or die(mysql_error());
					while ($data = mysql_fetch_array($kodeinstruktur)) {
						$select = $hasil['kodeinstruktur'] == $data['kodeinstruktur'] ? "selected" : "";
						echo "<option value='".$data['kodeinstruktur']."'".$select.">".$data['namalengkap']."</option>";
					} 
					 ?>
				</select>
			</td>
		</tr>

		<tr>
			<td>Fasilitas</td>
			<td>:</td>
			<td><textarea name="fasilitas" id="fasilitas" cols="30" rows="10"><?php echo $hasil['fasilitas']; ?></textarea></td>
		</tr>

		<tr>
			<td>Foto</td>
			<td>:</td>
			<td><img style="height: 120px; width: 120px;" src="../../gambar/desainweb/<?php echo $hasil['gambar']; ?>" alt=""></td>
			<tr>
				<td></td>
				<td></td>
				<td><input style="border: none;" type="file" name="gambar" id="gambar" value="<?php echo $hasil['gambar']; ?>"></td>
			</tr>
		</tr>

		<tr>
			<td></td>
			<td></td>
			<td><input id="edit" type="submit" name="edit" value="Ubah"></td>
		</tr>
	</table>

	<?php 
		$kodeolahraga   = @$_POST['kodeolahraga'];
		$namaolahraga   = @$_POST['namaolahraga'];
		$harga          = @$_POST['harga'];
		// $kodeinstruktur = @$_POST['kodeinstruktur'];
		$waktu          = @$_POST['waktu'];
		$waktu2         = @$_POST['waktu2'];
		$fasilitas         = @$_POST['fasilitas'];
		
		$sumber         = @$_FILES['gambar']['tmp_name'];
		$target         = '../../gambar/desainweb/';
		$nama_gambar    = @$_FILES['gambar']['name'];
		$imageFileType  = pathinfo($nama_gambar, PATHINFO_EXTENSION);

		if (@$_POST['edit']) {
			if ($nama_gambar == ""){
				mysql_query("UPDATE jenisolahraga SET kodeolahraga = '$kodeolahraga', namaolahraga = '$namaolahraga', waktu = '$waktu', waktu2 = '$waktu2', harga = '$harga', fasilitas = '$fasilitas' WHERE kodeolahraga = '$kodeolahraga'") or die(mysql_error());
				?><script>
					alert('Data Berhasil Di Ubah');
					window.location.href ='halamanadministrator.php?page=lihatdataaktivitasolahraga'
				</script><?php
			} else if ($imageFileType != 'jpg' && $imageFileType != 'jpeg' && $imageFileType != 'png') { ?>
				<script>
					alert('Foto Yang Di Izinkan Hanya Ekstensi .jpg Atau .png');
					window.location.href = 'halamanadministrator.php?page=lihatdataaktivitasolahraga';
				</script>
			<?php
			} else {
				$pindah = move_uploaded_file($sumber, $target.$nama_gambar);
				if ($pindah) {
						mysql_query("UPDATE jenisolahraga SET kodeolahraga = '$kodeolahraga', namaolahraga = '$namaolahraga', waktu = '$waktu', waktu2 = '$waktu2', harga = '$harga', gambar = '$nama_gambar', fasilitas = '$fasilitas' WHERE kodeolahraga = '$kodeolahraga'") or die(mysql_error());
						?><script>
							alert('Data Berhasil Di Ubah');
							window.location.href = 'halamanadministrator.php?page=lihatdataaktivitasolahraga';
						</script><?php
				} else {
					?>
					<script>
						alert('Gambar Gagal Di Upload');
						window.location.href = 'halamanadministrator.php?page=editdataaktivitasolahraga';
					</script><?php
				}
			}
		}
	 ?>

</form>