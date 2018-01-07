<?php 
$baris = 3;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 1;
$pagesql = "SELECT * FROM konfirmasi";
$pagequery = mysql_query($pagesql) or die(mysql_error());
$jumlahdata = mysql_num_rows($pagequery);
$maks = ceil($jumlahdata/$baris);
$mulai = $baris * ($hal - 1);
 ?>

<form action="" method="POST">
<table class="tabel2">
	<h4>Data Konfirmasi</h4>
	<input type="text" name="inputan_pencarian" placeholder="Masukan Kode Konfirmasi / Kode Pesan" style="width: 200px; padding: 5px; margin-left: 10px;">
	<input type="submit" name="cari_aktivitas" value="Cari" style="padding: 3px;">
	<tr>
		<th>Kode Konfirmasi</th>
		<th>Kode Pesan</th>
		<th>Nama Lengkap</th>
		<th>Aktivitas Olahraga</th>
		<th>Tanggal Aktivitas</th>
		<th>Waktu</th>
		<th>Bukti Bayar</th>
		<th>Aksi</th>
	</tr>

	<?php 
	$inputan_pencarian = @$_POST['inputan_pencarian'];
	$cari_aktivitas = @$_POST['cari_aktivitas'];
	if ($inputan_pencarian != "") {
		$sql = mysql_query("SELECT * FROM konfirmasi JOIN (transaksi JOIN member JOIN jenisolahraga) ON konfirmasi.kodebooking = transaksi.kodebooking AND konfirmasi.kodemember = member.kodemember AND transaksi.kodeolahraga = jenisolahraga.kodeolahraga WHERE kodekonfirmasi LIKE '%$inputan_pencarian%' OR konfirmasi.kodebooking LIKE '%$inputan_pencarian%'") or die(mysql_error());
	} else {
		$sql = mysql_query("SELECT * FROM konfirmasi JOIN (transaksi JOIN member JOIN jenisolahraga) ON konfirmasi.kodebooking = transaksi.kodebooking AND konfirmasi.kodemember = member.kodemember AND transaksi.kodeolahraga = jenisolahraga.kodeolahraga ORDER BY kodekonfirmasi ASC") or die(mysql_error());
	}
	$cek = mysql_num_rows($sql);
	if ($cek == 0) { ?>
		<tr>
			<td></td>
			<td></td>
			<td>Data Tidak DiTemukan</td>
		</tr>
	<?php 
	} else {
		while ($data = mysql_fetch_array($sql)) { 
			if ($data['status'] == 'Aktif' || $data['status'] == 'Proses') { ?>
				<tr hidden>
					<td hidden class="tampilan"><?php echo $data['kodekonfirmasi']; ?></td>
					<td hidden class="tampilan"><?php echo $data['kodebooking']; ?></td>
					<td hidden class="tampilan"><?php echo $data['namalengkap']; ?></td>
					<td hidden class="tampilan"><?php echo $data['namaolahraga']; ?></td>
					<td hidden class="tampilan"><?php echo $data['tanggal']; ?></td>
					<td hidden class="tampilan"><?php echo $data['waktu']; ?> - <?php echo $data['waktu2']; ?></td>
					<td hidden class="tampilan"><img style="width: 100px; height: 100px;" src="../../gambar/foto/<?php echo $data['buktibayar']; ?>"></td>
				</tr>
			<?php
			} else {
			?>
				<tr>
					<td class="tampilan"><?php echo $data['kodekonfirmasi']; ?></td>
					<td class="tampilan"><?php echo $data['kodebooking']; ?></td>
					<td class="tampilan"><?php echo $data['namalengkap']; ?></td>
					<td class="tampilan"><?php echo $data['namaolahraga']; ?></td>
					<td class="tampilan"><?php echo $data['tanggal']; ?></td>
					<td class="tampilan"><?php echo $data['waktu']; ?> - <?php echo $data['waktu2']; ?></td>
					<td class="tampilan"><a href="#<?php echo $data['buktibayar']; ?>"><img style="width: 100px; height: 100px;" src="../../gambar/foto/<?php echo $data['buktibayar']; ?>"></a></td>
					<div class="overlay" id="<?php echo $data['buktibayar']; ?>">
						<a href="#" class="close">X Close</a>
						<img src="../../gambar/foto/<?php echo $data['buktibayar']; ?>" alt="">
					</div>
					<td class="tampilan">
						<a href="hapus/hapusdatakonfirmasi.php?kodekonfirmasi=<?php echo $data['kodekonfirmasi']; ?>" onclick="return confirm('Anda Yakin Ingin Menghapus Data?');"><i class="fa fa-trash-o" title="Hapus"></i></a>

						<?php 
							if ($data['status'] == 'Proses') { ?>
								<a hidden href="?page=ubahdatabooking&kodebooking=<?php echo $data['kodebooking']; ?>"><i class="fa fa-check" title="Aktifkan"></i></a>
							<?php 
							} else { ?>
								<a href="?page=ubahdatabooking&kodebooking=<?php echo $data['kodebooking']; ?>"><i class="fa fa-check" title="Aktifkan"></i></a>
							<?php
							}
			}
							?>

				</td>
			</tr>
		<?php
		}
	}
		 ?>
</table>
<table>
	<tr>
		<td style="border: none;">Halaman Ke : <?php for ($i=1; $i <= $maks; $i++) {
			echo"<a href='?page=lihatdatakonfirmasi&hal=$i'>$i  </a>";
	 	} ?></td>
	</tr>
</table>
</form>