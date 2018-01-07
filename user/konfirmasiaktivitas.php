<script>
	function validasiInput(form) {
	var fileSize = document.getElementById("Gambar").files[0];
	var harusHuruf = /^[a-zA-Z ]+$/;
	var nomor = /^[0-9]+$/;

		if (form.bank_sumber.value == '' && form.norek.value == '' && form.banktujuan.value == '') {
			alert('Harap Melengkapi Data Terlebih Dahulu');
			form.bank_sumber.focus();
			return false;
		}if (form.bank_sumber.value == '') {
			alert('Harap Melengkapi Data Bank Sumber Terlebih Dahulu');
			form.bank_sumber.focus();
			return false;
		} if (!harusHuruf.test(form.bank_sumber.value)) {
			alert('Inputan Bank Sumber Hanya Diperbolehkan Huruf');
			form.bank_sumber.focus();
			return false;
		}if (form.norek.value == '') {
			alert('Harap Melengkapi Data Nomor Rekening Terlebih Dahulu');
			form.bank_sumber.focus();
			return false;
		} if (form.banktujuan.value == '') {
			alert('Harap Melengkapi Data Bank Tujuan Terlebih Dahulu');
			form.bank_sumber.focus();
			return false;
		} if (!nomor.test(form.norek.value)) {
			alert('Hanya Diperbolehkan Angka');
			form.norek.focus();
			return false;
		} if (form.buktibayar.value == '') {
			alert('Anda Belum Mengupload Bukti Transfer');
			form.buktibayar.focus();
			return false;
		} if (fileSize.size > 5097152) {
			alert("File Maximum 5 MegaByte");
			return false;
		}
		 else {
			return true;
		}
	}
</script>
<h3>Konfirmasi Data Pemesanan</h3>
<form action="" method="POST" enctype="multipart/form-data" onsubmit="return validasiInput(this);">
	<table class="tabel1" style="margin-top: 30px;">

		<?php 
		$kodebooking = @$_GET['kodebooking'];
		$query = mysql_query("SELECT * FROM transaksi JOIN (member JOIN jenisolahraga) ON transaksi.kodemember = member.kodemember AND transaksi.kodeolahraga = jenisolahraga.kodeolahraga WHERE kodebooking = '$kodebooking'") or die(mysql_error());
		$data = mysql_fetch_array($query);
		 ?>

		 <?php 
		// Nomor Otomatis
		$today = date('Ymd');
		$query3 = mysql_query("SELECT MAX(kodekonfirmasi) AS LAST FROM Konfirmasi WHERE kodekonfirmasi LIKE '$today%'") or die(mysql_error());
		$data3 = mysql_fetch_array($query3);
		$nomor = $data3['LAST'];
		$akhirNoUrut = substr($nomor, 12, 4);
		$noUrut = $akhirNoUrut + 1;
		$lanjutNoUrut = $today.$data['kodeolahraga'].sprintf('%04s', $noUrut); 
		// Akhir Nomor Otomatis
		 ?>

		 <tr>
			<td>Kode Konfirmasi</td>
			<td>:</td>
			<td><input type="text" name="Konfirmasi" value="<?php echo $lanjutNoUrut; ?>" readonly></td>
		</tr>

		
		<tr>
			<td>Kode Pemesanan</td>
			<td>:</td>
			<td><input type="text" name="kodebooking" value="<?php echo $data['kodebooking']; ?>" readonly></td>
		</tr>

		<tr>
			<td>Kode Anggota</td>
			<td>:</td>
			<td><input type="text" name="kodemember" value="<?php echo $data['kodemember']; ?>" readonly></td>
		</tr>

		<tr>
			<td>Atas Nama</td>
			<td>:</td>
			<td><input type="text" name="namalengkap" value="<?php echo $data['namalengkap']; ?>" readonly></td>
		</tr>

		<tr>
			<td>Aktivitas Olahraga</td>
			<td>:</td>
			<td><input type="text" name="namaolahraga" value="<?php echo $data['namaolahraga']; ?>" readonly></td>
		</tr>

		<tr>
			<td>Waktu</td>
			<td>:</td>
			<td><input type="text" name="waktu" value="<?php echo $data['waktu']; ?> - <?php echo $data['waktu2']; ?>" readonly></td>
		</tr>

		<tr>
			<td>Tanggal Aktivitas</td>
			<td>:</td>
			<td><input type="text" name="tanggal" value="<?php echo $data['tanggal']; ?>" readonly></td>
		</tr>

		<tr>
			<td>Bank Sumber</td>
			<td>:</td>
			<td><input type="text" name="bank_sumber" maxlength="20" value=""></td>
		</tr>

		<tr>
			<td>Nomor Rekening</td>
			<td>:</td>
			<td><input type="text" name="norek" maxlength="16" value=""></td>
		</tr>

		<tr>
			<td>Bank Tujuan</td>
			<td>:</td>
			<td><input type="text" name="banktujuan" value="Mandiri" readonly></td>
		</tr>

		<tr>
			<td>Bukti Bayar</td>
			<td>:</td>
			<td style="border: none;"><input type="file" id="Gambar" name="buktibayar" style="border: none;"></td>
		</tr>

		<tr>
			<td></td>
			<td></td>
			<td><input type="submit" name="simpan" value="Unggah"></td>
		</tr>
	</table>

	<?php 
	$kodekonfirmasi = @$_POST['Konfirmasi'];
	$kodebooking = @$_POST['kodebooking'];
	$kodemember = @$_POST['kodemember'];
	$status = 'Booking';
	$banksumber = @$_POST['bank_sumber'];
	$norek = @$_POST['norek'];
	$banktujuan = @$_POST['banktujuan'];

	$sumber = @$_FILES['buktibayar']['tmp_name'];
	$target = "../gambar/foto/";
	$nama_gambar = @$_FILES['buktibayar']['name'];

	$imageFileType = pathinfo($nama_gambar, PATHINFO_EXTENSION);

if (@$_POST['simpan']) {
	if ($_FILES['buktibayar']['size'] > 5000000) {
		?><script>
			alert('Gambar Maksimal 5 MB ');
		</script><?php
	} else if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
		?><script>
			alert('File Gambar Yang Di Izinkan Hanya .jpg, .png');
			window.location.href = 'halamanuser.php?page=konfirmasibooking';
		</script><?php
	} else {
		$pindah = move_uploaded_file($sumber, $target.$nama_gambar);
		if ($pindah){
			mysql_query("INSERT INTO Konfirmasi VALUES ('$kodekonfirmasi', '$kodebooking', '$kodemember','$banksumber','$norek', '$banktujuan' , '$nama_gambar')") or die(mysql_error());
			mysql_query("UPDATE transaksi SET status = '$status' WHERE kodebooking = '$kodebooking'") or die(mysql_error());
			?><script>
				alert('Terima Kasih Anda Telah Melakukan Konfirmasi Pembayaran, Anda Dapat Mencetak Kode Booking');
				window.location.href = '?page=lihataktivitas';
			</script><?php
		}
	}
}
	 ?>
</form>