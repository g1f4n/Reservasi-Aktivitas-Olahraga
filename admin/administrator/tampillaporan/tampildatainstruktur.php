<?php 
$baris = 3;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 1;
$pagesql = "SELECT * FROM instruktur";
$pagequery = mysql_query($pagesql) or die(mysql_error());
$jumlahdata = mysql_num_rows($pagequery);
$maks = ceil($jumlahdata/$baris);
$mulai = $baris * ($hal - 1);
 ?>

<h4>Laporan Data Instruktur</h4>
<form action="" method="POST">
	<input type="text" name="inputan_pencarian" placeholder="Masukan Kode Instruktur / Nama Instruktur" style="width: 200px; padding: 5px; margin-left: 10px;">
	<input type="submit" name="cari_aktivitas" value="Cari" style="padding: 3px;">
</form>
<form action="../../cetaklaporan/cetak-datainstruktur.php" target="_BLANK" method="POST">
<table class="tabel2">
	<tr>
		<th>Kode Instruktur</th>
		<th>Nama Lengkap</th>
		<th>Jenis Kelamin</th>
		<th>Nomor Telepon</th>
		<th>Alamat</th>
		<th>Email</th>
		<th>Foto</th>
		<th>Aksi</th>
	</tr>

	<?php 
	$inputan_pencarian = @$_POST['inputan_pencarian'];
	$cari_aktivitas = @$_POST['cari_aktivitas'];
	if ($inputan_pencarian != "") {
		$sql = mysql_query("SELECT * FROM instruktur WHERE kodeinstruktur LIKE '%$inputan_pencarian%' OR namalengkap LIKE '%$inputan_pencarian%'") or die(mysql_error());
	} else {
		$sql = mysql_query("SELECT * FROM instruktur LIMIT $mulai, $baris") or die(mysql_error());
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
				<td class="tampilan"><?php echo $data['kodeinstruktur']; ?></td>
				<td class="tampilan"><?php echo $data['namalengkap']; ?></td>
				<td class="tampilan"><?php echo $data['jeniskelamin']; ?></td>
				<td class="tampilan"><?php echo $data['telp']; ?></td>
				<td class="tampilan"><?php echo $data['alamat']; ?></td>
				<td class="tampilan"><?php echo $data['email']; ?></td>
				<td class="tampilan"><img src="../../gambar/instruktur/<?php echo $data['gambar1']; ?>" alt="Tidak Ada Gambar" style="height: 120px; width: 120px;"></td>
				<td class="tampilan">
					<a target="_blank" href="laporan-solo/laporaninstruktur.php?kodeinstruktur=<?php echo $data['kodeinstruktur']; ?>"><i class="fa fa-print" title="Cetak"></i></a>
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
			echo"<a href='?page=lihatdatainstruktur&hal=$i'>$i  </a>";
	 	} ?></td>
	</tr>
	<tr>
        <td><input type="submit" name="submit" value="Cetak Data Keseluruhan"></td>
    </tr>
</table>
</form>