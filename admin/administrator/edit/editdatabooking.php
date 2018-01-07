<script>
	function validasiInput(form) {
		var nomor = /^[0-9]$/;
		if (form.tanggal.value == '' && form.jumlah.value == '') {
			alert('Inputan Tanggal dan Jumlah Tidak Boleh Kosong');
			form.tanggal.focus();
			return false;
		} if (form.tanggal.value == '') {
			alert('Inputan Tanggal Tidak Boleh Kosong');
			form.tanggal.focus();
			return false;
		} if (form.jumlah.value == '') {
			alert('Jumlah Orang Tidak Boleh Kosong');
			form.jumlah.focus();
			return false;
		} if (!nomor.test(form.jumlah.value)) {
			alert('Harap Mengisikan Angka');
			form.jumlah.focus();
			return false;
		} else {
			return true;
		}
	}
</script>

<h4>Edit Data Booking</h4>
<form action="" method="POST" enctype="multipart/form-data" onsubmit="return validasiInput(this);">
	<table>
	<?php 
	$kodebooking = @$_GET['kodebooking'];
	$ubahdata = mysql_query("SELECT * FROM transaksi JOIN (member JOIN jenisolahraga) ON transaksi.kodemember = member.kodemember AND transaksi.kodeolahraga = jenisolahraga.kodeolahraga WHERE kodebooking = '$kodebooking'") or die(mysql_error());
	$hasil = mysql_fetch_array($ubahdata);
	 ?>
		<tr>
			<td>Kode Booking</td>
			<td>:</td>
			<td><input type="text" name="kodebooking" value="<?php echo $hasil['kodebooking']; ?>" readonly></td>
		</tr>	

		<tr>
			<td>Kode Member</td>
			<td>:</td>
			<td><input type="text" name="kodemember" value="<?php echo $hasil['kodemember']; ?>" readonly></td>
		</tr>

		<tr>
			<td>Akivitas Olahraga</td>
			<td>:</td>
			<td>
				<select name="kodeolahraga" id="kodeolahraga">
					<?php 
					$kodeolahraga = mysql_query("SELECT * FROM jenisolahraga ORDER BY namaolahraga") or die(mysql_error());
					while ($data = mysql_fetch_array($kodeolahraga)) {
						$select = $hasil['kodeolahraga'] == $data['kodeolahraga'] ? "selected" : "";
						echo "<option value='".$data['kodeolahraga']."'".$select.">".$data['namaolahraga']."</option>";
					}
					 ?>
				</select>
			</td>
		</tr>

		<!--  -->
		<link rel="stylesheet" href="../../../js/jquery_ui.custom/jquery-ui.css">
		<script src="../../../js/jquery-2.1.4.js" type="text/javascript"></script>
		<script src="../../../js/jquery_ui.custom/jquery-ui.js" type="text/javascript"></script>
		<script>
		var $jnoc = jQuery.noConflict();
		$jnoc(document).ready(function () {
		$jnoc.datepicker.setDefaults({
		            dateFormat: 'yy/mm/dd',
		            changeMonth: true,
		            changeYear: true,
		            numberOfMonths: 1,
		            constrainInput:true
		        });
		$jnoc('#tglL').datepicker();
		});
		</script>

		<!--  -->

		<tr>
			<td>Tanggal</td>
			<td>:</td>
			<td><input id="tglL" type="text" class="tanggal" name="tanggal" value="<?php echo $hasil['tanggal']; ?>"></td>
		</tr>

		<tr>
			<td>Jumlah Orang</td>
			<td>:</td>
			<td><input type="text" name="jumlah" value="<?php echo $hasil['jumlah']; ?>" readonly></td>
		</tr>

		<tr>
			<td>Status</td>
			<td>:</td>
			<td>
				<select name="status" id="status">
					<option value="Booking" <?php if($hasil['status'] == 'Booking') { echo 'selected'; } ?>>Booking</option>
					<option value="Proses" <?php if($hasil['status'] == 'Proses') { echo 'selected'; } ?>>Proses</option>
				</select>
			</td>
		</tr>

		<tr>
			<td></td>
			<td></td>
			<td><input id="edit" type="submit" name="edit" value="EDIT" readonly></td>
		</tr>
	</table>
	<?php 
	$kodebooking  = @$_POST['kodebooking'];
	$kodemember   = @$_POST['kodemember'];
	$kodeolahraga = @$_POST['kodeolahraga'];
	$tanggal      = @$_POST['tanggal'];
	$jumlah       = @$_POST['jumlah'];
	$status       = @$_POST['status'];

	if (@$_POST['edit']) {
		mysql_query("UPDATE transaksi SET kodemember = '$kodemember', kodeolahraga = '$kodeolahraga', tanggal = '$tanggal', jumlah = '$jumlah', status = '$status' WHERE kodebooking = '$kodebooking'") or die(mysql_error());
		?><script>window.location.href = "halamanadministrator.php?page=lihatdatabooking";</script><?php
	}

	 ?>
</form>