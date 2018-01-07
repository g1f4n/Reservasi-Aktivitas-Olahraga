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
	<h4>Laporan Data Konfirmasi</h4>
	<input type="text" name="inputan_pencarian" placeholder="Masukan Kode Konfirmasi / Kode Pesan" style="width: 200px; padding: 5px; margin-left: 10px;">
	<input type="submit" name="cari_aktivitas" value="Cari" style="padding: 3px;">
</form>
<form action="../../cetaklaporan/cetak-datakonfirmasi.php" target="_BLANK" method="POST">
<table class="tabel2">
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
		$sql = mysql_query("SELECT * FROM konfirmasi JOIN (transaksi JOIN member JOIN jenisolahraga) ON konfirmasi.kodebooking = transaksi.kodebooking AND konfirmasi.kodemember = member.kodemember AND transaksi.kodeolahraga = jenisolahraga.kodeolahraga ORDER BY kodekonfirmasi ASC LIMIT $mulai, $baris") or die(mysql_error());
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
					<td class="tampilan"><img style="width: 100px; height: 100px;" src="../../gambar/foto/<?php echo $data['buktibayar']; ?>"></td>
					<td class="tampilan">
						<a target="_blank" href="../kasir/tampillaporan-solo/laporankonfirmasi.php?kodekonfirmasi=<?php echo $data['kodekonfirmasi']; ?>"><i class="fa fa-print" title="Cetak"></i></a>

							<?php
							
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
			echo"<a href='?page=laporankonfirmasi&hal=$i'>$i  </a>";
	 	} ?></td>
	</tr>
	<tr>
        <td><input type="submit" name="submit" value="Cetak Data Keseluruhan"></td>
    </tr>
</table>
</form>