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
	            minDate: dateToday
	        });
	$jnoc('#tglL').datepicker();
	});
</script>

<h3>Atur Ulang Jadwal Aktivitas</h3>
<form action="" method="POST" enctype="multipart/form-data">
	<table class="tabel1" style="margin-top: 30px;">
	<?php 
	$kodebooking = @$_GET['kodebooking'];
	$query      = mysql_query("SELECT * FROM transaksi JOIN (member JOIN jenisolahraga) ON transaksi.kodemember = member.kodemember AND transaksi.kodeolahraga = jenisolahraga.kodeolahraga WHERE kodebooking = '$kodebooking'") or die(mysql_error());
	$data       = mysql_fetch_array($query);
	 ?>
		<tr>
			<td>Kode Pemesanan</td>
			<td>:</td>
			<td><input type="text" name="kodebooking" value="<?php echo $data['kodebooking']; ?>" readonly></td>
		</tr>
		<tr>
			<td>Atas Nama</td>
			<td>:</td>
			<td><input type="text" name="namalengkap" maxlength="50" value="<?php echo $data['namalengkap']; ?>" readonly></td>
		</tr>
		<tr>
			<td>Aktivitas Olahraga</td>
			<td>:</td>
			<td><input type="text" name="namaolahraga" maxlength="20" value="<?php echo $data['namaolahraga']; ?>" readonly></td>
		</tr>
		<tr>
			<td>Tanggal Aktivitas</td>
			<td>:</td>
			<td><input type="text" name="tanggal" id="tglL" value="<?php echo $data['tanggal']; ?>"></td>
		</tr>

		<tr>
			<td></td>
			<td></td>
			<td><input type="submit" name="reschedule" value="Jadwal Ulang"></td>
		</tr>
	</table>

	<?php 
	$tanggal = @$_POST['tanggal'];

	if (@$_POST['reschedule']) {
		mysql_query("UPDATE transaksi SET tanggal = '$tanggal' WHERE kodebooking = '$kodebooking'") or die(mysql_error());
		?><script>
			alert('Jadwal Berhasil Di Atur Ulang');
			window.location.href = '?page=lihataktivitas';
		</script><?php
	}
	 ?>
</form>