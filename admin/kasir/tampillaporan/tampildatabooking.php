<?php 
$baris = 3;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 1;
$pagesql = "SELECT * FROM transaksi";
$pagequery = mysql_query($pagesql) or die(mysql_error());
$jumlahdata = mysql_num_rows($pagequery);
$maks = ceil($jumlahdata/$baris);
$mulai = $baris * ($hal - 1);
 ?>
<form action="" method="POST">
	<h4>Laporan Data Pemesanan</h4>
	<input type="text" name="inputan_pencarian" placeholder="Masukan Kode Pemesanan" style="width: 200px; padding: 5px; margin-left: 10px;">
	<input type="submit" name="cari_aktivitas" value="Cari" style="padding: 3px;">
</form>
<form action="../../cetaklaporan/cetak-databooking.php" target="_BLANK" method="POST">
<table class="tabel2">
	<tr>
		<th>Kode Pesan</th>
		<th>Kode Anggota</th>
		<th>Aktivitas Olahraga</th>
		<th>Instruktur</th>
		<th>Tanggal Pemakaian</th>
		<th>Waktu</th>
		<th>Jumlah Orang</th>
		<th>Status</th>
		<th>Aksi</th>
	</tr>

	<?php 
	$status = 'Proses';
	$inputan_pencarian = @$_POST['inputan_pencarian'];
	$cari_aktivitas = @$_POST['cari_aktivitas'];
	if ($inputan_pencarian != "") {
		$sql = mysql_query("SELECT * FROM transaksi JOIN (member JOIN jenisolahraga JOIN instruktur) ON transaksi.kodemember = member.kodemember AND transaksi.kodeolahraga = jenisolahraga.kodeolahraga AND jenisolahraga.kodeinstruktur = instruktur.kodeinstruktur WHERE status = '$status' AND kodebooking LIKE '%$inputan_pencarian%'") or die(mysql_error());
	} else {
	$sql = mysql_query("SELECT * FROM transaksi JOIN (member JOIN jenisolahraga JOIN instruktur) ON transaksi.kodemember = member.kodemember AND transaksi.kodeolahraga = jenisolahraga.kodeolahraga AND jenisolahraga.kodeinstruktur = instruktur.kodeinstruktur WHERE status = 'Proses' LIMIT $mulai, $baris") or die(mysql_error());
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
			 if($data['status'] == 'Proses') { ?>
				<tr>
					<td class="tampilan"><?php echo $data['kodebooking']; ?></td>
					<td class="tampilan"><?php echo $data['kodemember']; ?></td>
					<td class="tampilan"><?php echo $data['namaolahraga']; ?></td>
					<td class="tampilan"><?php echo $data['namalengkap']; ?></td>
					<td class="tampilan"><?php echo $data['tanggal']; ?></td>
					<td class="tampilan"><?php echo $data['waktu'];?> - <?php echo $data['waktu2']; ?></td>
					<td class="tampilan"><?php echo $data['jumlah'];?> Orang</td>
					<td class="tampilan"><?php echo $data['status']; ?></td>
					<td class="tampilan">
						<a target="_blank" href="tampillaporan-solo/laporanbooking.php?kodebooking=<?php echo $data['kodebooking']; ?>"><i class="fa fa-print" title="Cetak"></i></a>
						<a href="hapus/hapusdatabooking.php?kodebooking=<?php echo $data['kodebooking']; ?>" onclick="return confirm('Data Berhasil Di Hapus?');"><i class="fa fa-trash-o" title="Hapus"></i></a>
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
			echo"<a href='?page=laporanbooking&hal=$i'>$i  </a>";
	 	} ?></td>
	</tr>
	<tr>
        <td><input type="submit" name="submit" value="Cetak Data Keseluruhan"></td>
    </tr>
</table>
</form>