<script>
function validasiInput(form) {
	var jumlah = /^[0-9]{1,1}$/;
	if (form.jumlah.value == "" && form.tanggal.value == "") {
		alert('Inputan Tidak Boleh Kosong');
		form.tanggal.focus();
		return false;
	} if (!jumlah.test(form.jumlah.value)) {
		alert('Inputan Jumlah Harus Angka Dan Maksimal Booking hanya 9 orang');
		form.jumlah.focus();
		return false;
	} if (form.jumlah.value == "") {
		alert('Inputan Jumlah Tidak Boleh Kosong');
		form.jumlah.focus();
		return false;
	} if (form.tanggal.value == "") {
		alert('Inputan Tanggal Tidak Boleh Kosong');
		form.tanggal.focus();
		return false;
	} else {
		return true;
	}	
}
</script>

<form action="" method="POST" enctype="multipart/form-data" onsubmit="return validasiInput(this);">
	<h4>Formulir Pemesanan</<h4>
	<table class="tabel2">
	<?php 
		include '../fungsi/koneksi/koneksi.php';
		$username = @$_SESSION['email'];
		$query = mysql_query("SELECT * FROM member WHERE email = '$username'") or die(mysql_error());
		$data2 = mysql_fetch_array($query);
	?>
	<?php
		// Nomor Otomatis
		$today = date('Ymd');
		$query3 = mysql_query("SELECT MAX(kodebooking) AS LAST FROM transaksi WHERE kodebooking LIKE '$today%'") or die(mysql_error());
		$data3 = mysql_fetch_array($query3);
		$nomor = $data3['LAST'];
		$akhirNoUrut = substr($nomor, 8, 4);
		$noUrut = $akhirNoUrut + 1;
		$lanjutNoUrut = $today.sprintf('%04s', $noUrut); 
		// Akhir Nomor Otomatis
	 ?>
		<tr>
			<td><label for="kodebooking">Kode Pemesanan </label></td>
			<td><input type="text" name="kodebooking" id="kodebooking" value="<?php echo $lanjutNoUrut; ?>" readonly></td><br>
		</tr>
		<tr>
			<td><label for="nama">Kode Anggota </label></td>
			<td><input type="text" name="nama" id="nama" value="<?php echo $data2['kodemember']; ?>" readonly></td><br>
		</tr>
		<?php 

		$kodeolahraga = @$_GET['kodeolahraga'];
		$query = mysql_query("SELECT * FROM jenisolahraga WHERE kodeolahraga = '$kodeolahraga'") or die(mysql_error());
		$jenisolahraga = mysql_fetch_array($query)
		 ?>
		<tr>
			<td><label for="kodeolahraga">Kode Olahraga </label></td>
			<td><input type="text" name="kodeolahraga" id="kodeolahraga" value="<?php echo $jenisolahraga['kodeolahraga']; ?>" readonly></td><br>
		</tr>

		<script>
		var dateToday = new Date();
			var $jnoc = jQuery.noConflict();
			$jnoc(document).ready(function () {
			$jnoc.datepicker.setDefaults({
			            dateFormat: 'yy/mm/dd',
			            changeMonth: true,
			            changeYear: true,
			            numberOfMonths: 1,
			            constrainInput:true,
			            minDate: dateToday,
			        });
			$jnoc('#tglL').datepicker();
			$jnoc('#tanggalkonfirmasi').datepicker();
			});
		</script>

		<tr>
			<td><label for="tanggal">Tanggal Aktivitas</label></td>
			<td><input type="text" class="tanggal" id="tglL" name="tanggal"></td>
		</tr>

		<script>
		function totalHarga() {
			var jumlah = document.getElementById('jumlah').value;
			var harga = document.getElementById('harga').value;
			var total = jumlah * harga;
			document.getElementById('totalharga').value = total;
		}
		</script>

		<?php 
		$total = 1;
		 ?>

		<tr>
			<td><label for="jumlah">Jumlah Orang</label></td>
			<td><input type="text" class="jumlah" id="jumlah" name="jumlah" value="<?php echo $total; ?>" onkeyup="return totalHarga();"></td>
		</tr>

		<tr>
			<td><label for="harga">Harga</label></td>
			<td><input type="text" id="harga" name="harga" value="<?php echo $jenisolahraga['harga']; ?>" readonly></td>
		</tr>

		<tr>
			<td><label for="totalharga">Total Harga</label></td>
			<td><input type="text" id="totalharga" name="totalharga" value="<?php echo $jenisolahraga['harga']; ?>" readonly></td>
		</tr>

		<tr>
			<td></td>
			<td class="gambar"><input class="edit" type="submit" name="pesan" value="Kirim"></td>
		</tr>
	</table>
	<?php 
	$kodebooking = @$_POST['kodebooking'];
	$nama = @$_POST['nama'];
	$kodeolahraga = @$_POST['kodeolahraga'];
	$tanggal = @$_POST['tanggal'];
	$harga = @$_POST['totalharga'];
	$status = 'Proses';
	$jumlah = @$_POST['jumlah'];
	$terlogin = $data2['email'];
	$query10 = mysql_query("SELECT * FROM transaksi JOIN (member JOIN jenisolahraga) ON transaksi.kodeolahraga = jenisolahraga.kodeolahraga AND transaksi.kodemember = member.kodemember WHERE jenisolahraga.kodeolahraga = '$kodeolahraga' AND transaksi.tanggal = '$tanggal' AND email = '$terlogin'") or die(mysql_error());
	$cek = mysql_num_rows($query10);

		if (@$_POST['pesan']) {
			if ($cek == 1) {
				?><script>alert('Maaf Anda Sudah Memesan Aktivitas Olahraga Tersebut');</script><?php
			} else {
				mysql_query("INSERT INTO transaksi VALUES('$kodebooking', '$nama', '$kodeolahraga', '$tanggal', '$jumlah', '$status', '$harga')") or die(mysql_error());
				?><script>
					alert('Terima Kasih Telah Booking Aktivitas, Silahkan Lakukan Pembayaran dan Konfirmasi Pembayaran');
					window.location.href = '?page=konfirmasibooking';
				</script><?php
			}
		}
	?>
</form>