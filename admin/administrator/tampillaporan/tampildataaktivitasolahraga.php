<?php 
$baris = 3;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 1;
$pagesql = "SELECT * FROM jenisolahraga";
$pagequery = mysql_query($pagesql) or die(mysql_error());
$jumlahdata = mysql_num_rows($pagequery);
$maks = ceil($jumlahdata/$baris);
$mulai = $baris * ($hal - 1);
 ?>
<form action="" method="POST">
	<h4>Laporan Data Aktivitas Olahraga</h4>
	<input type="text" name="inputan_pencarian" placeholder="Masukan Kode Olahraga / Aktivitas Olahraga" style="width: 200px; padding: 5px; margin-left: 10px;">
	<input type="submit" name="cari_aktivitas" value="Cari" style="padding: 3px;">
</form>
<form action="../../cetaklaporan/cetak-dataaktivitasolahraga.php" target="_BLANK" method="POST">
<table class="tabel2">
	<tr>
		<th>Kode Olahraga</th>
		<th>Aktivitas Olahraga</th>
		<th>Harga</th>
		<th>Waktu</th>
		<th>Kode Instruktur</th>
		<th>Nama Instruktur</th>
		<th>Foto</th>
		<th>Aksi</th>
	</tr>

	<?php 
	$inputan_pencarian = @$_POST['inputan_pencarian'];
	$cari_aktivitas = @$_POST['cari_aktivitas'];
	if ($inputan_pencarian != "") {
		$sql = mysql_query("SELECT * FROM jenisolahraga JOIN instruktur ON jenisolahraga.kodeinstruktur = instruktur.kodeinstruktur WHERE kodeolahraga LIKE '%$inputan_pencarian%' OR namaolahraga LIKE '%$inputan_pencarian%'") or die(mysql_error());
	} else {
		$sql = mysql_query("SELECT * FROM jenisolahraga JOIN instruktur ON jenisolahraga.kodeinstruktur = instruktur.kodeinstruktur ORDER BY kodeolahraga ASC LIMIT $mulai, $baris") or die(mysql_error());
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
		while ($data = mysql_fetch_array($sql)) { ?>
			<tr>
				<td class="tampilan"><?php echo $data['kodeolahraga']; ?></td>
				<td class="tampilan"><?php echo $data['namaolahraga']; ?></td>
				<td class="tampilan"><?php echo $data['harga']; ?></td>
				<td class="tampilan"><?php echo $data['waktu']; ?> - <?php echo $data['waktu2']; ?></td>
				<td class="tampilan"><?php echo $data['kodeinstruktur']; ?></td>
				<td class="tampilan"><?php echo $data['namalengkap']; ?></td>
				<td class="tampilan"><img style="width: 60px; height: 60px;" src="../../gambar/desainweb/<?php echo $data['gambar']; ?>" alt="Tidak Ada Foto"></td>
				<td class="tampilan">
					<a target="_BLANK" href="laporan-solo/laporanaktivitasolahraga.php?kodeolahraga=<?php echo $data['kodeolahraga']; ?>"><i class="fa fa-print" title="Cetak"></i></a>
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
			echo"<a href='?page=laporanaktivitasolahraga&hal=$i'>$i  </a>";
	 	} ?></td>
	</tr>
	<tr>
        <td><input type="submit" name="submit" value="Cetak Data Keseluruhan"></td>
    </tr>
</table>
</form>