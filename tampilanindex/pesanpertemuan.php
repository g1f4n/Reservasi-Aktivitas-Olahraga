<!-- Total Harga -->
<!-- <script>
	function totalHarga(form) {
	var jumlah = 
		if (form.jumlah.value) {
			totalharga;
		}
	}
</script> -->

<!-- Akhir Total Harga -->
<div class="daftar" style="margin: 20px auto;">
	<h2>Pemesanan Per Pertemuan</h2>
	<hr style="margin-bottom: 10px;">
	<form action="" method="POST">
		<table>
			<h3></h3>

			<?php
			// Nomor Otomatis
			include 'fungsi/koneksi/koneksi.php';
			$today = date('Ymd');
			$query3 = mysql_query("SELECT MAX(kodebooking) AS LAST FROM transaksi WHERE kodebooking LIKE '$today%'") or die(mysql_error());
			$data3 = mysql_fetch_array($query3);
			$nomor = $data3['LAST'];
			$akhirNoUrut = substr($nomor, 8, 4);
			$noUrut = $akhirNoUrut + 1;
			$lanjutNoUrut = $today.sprintf('%04s', $noUrut); 
			// Akhir Nomor Otomatis

			// Kode Member
			$kodemember = 'term';
			// Akhir Kode Member
		 ?>

			<tr>
				<td>Kode Booking</td>
				<td>:</td>
				<td><input class="inputRegis" type="text" name="kodebooking" value="<?php echo $lanjutNoUrut; ?>" readonly></td>
			</tr>
			<!-- GET Kode Olahraga -->
			<?php
			$kodeolahraga = @$_GET['kodeolahraga'];
			$query = mysql_query("SELECT * FROM jenisolahraga WHERE kodeolahraga = '$kodeolahraga'") or die(mysql_error());
			$jenisolahraga = mysql_fetch_array($query);
			 ?>
			<!-- Akhir GET Kode Olahraga -->

			<tr>
				<td>Kode Aktivitas</td>
				<td>:</td>
				<td><input class="inputRegis" type="text" name="kodeolahraga" value="<?php echo $jenisolahraga['kodeolahraga']; ?>" readonly></td>
			</tr>

			<tr>
				<td>Nama Aktivitas</td>
				<td>:</td>
				<td><input class="inputRegis" type="text" name="jenisolahraga" value="<?php echo $jenisolahraga['namaolahraga']; ?>" readonly></td>
			</tr>

			<tr>
				<td>Nama Lengkap</td>
				<td>:</td>
				<td><input class="inputRegis" type="text" name="nama"></td>
			</tr>

			<!-- Date Picker -->
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
			<!-- Akhir Date Picker -->

			<tr>
				<td>Tanggal Aktivitas</td>
				<td>:</td>
				<td><input class="inputRegis" type="text" name="Tanggal" id="tglL"></td>
			</tr>

			<?php $total = 1; ?>

			<tr>
				<td>Jumlah Orang</td>
				<td>:</td>
				<td><input class="inputRegis" id="jumlah" type="text" name="jumlah" value="<?php echo $total; ?>" onkeyup="totalHarga();"></td>
			</tr>

			<script>
			function totalHarga() {
				var jumlah = document.getElementById('jumlah').value;
				var harga = document.getElementById('harga').value;
				var total = jumlah * harga;
				document.getElementById('totalharga').value = total;
			}
			</script>

			<tr>
				<td>Harga</td>
				<td>:</td>
				<td><input class="inputRegis" id="harga" type="text" name="harga" onfocus="return totalHarga();" value="<?php echo $jenisolahraga['harga']; ?>"></td>
			</tr>

			<tr>
				<td>Total Harga</td>
				<td>:</td>
				<td><input class="inputRegis" id="totalharga" type="text" name="totalharga" value="<?php echo $jenisolahraga['harga']; ?>"></td>
			</tr>

			<tr>
				<td></td>
				<td></td>
				<td><input type="submit" id="submit" class="btn btn-send" value="Pesan" name="pesan"></td>
				<td><a href="?page=lihataktivitas">Kembali</a></td>
			</tr>
		</table>

		<?php 
		$kodebooking   = @$_POST['kodebooking'];
		$kodeolahraga  = @$_POST['kodeolahraga'];
		$nama          = @$_POST['nama'];
		$jumlah        = @$_POST['jumlah'];
		$Tanggal       = @$_POST['Tanggal'];
		$totalharga    = @$_POST['totalharga'];
		$status		   = 'Proses';
		$kodemember    = 'term';
		$totalharga    = @$_POST['totalharga'];

		if (@$_POST['pesan']) {
			mysql_query("INSERT INTO transaksi VALUES ('$kodebooking', 'kodeolahraga', '$kodemember', '$nama', '$jumlah', '$Tanggal', '$status', '$totalharga')") or die(mysql_error());
		}

		 ?>
	</form>
</div>