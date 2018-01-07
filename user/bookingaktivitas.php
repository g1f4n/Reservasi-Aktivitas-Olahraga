<!-- Paggination -->
<?php 
$baris = 5;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 1;
$pagesql = "SELECT * FROM transaksi";
$pagequery = mysql_query($pagesql) or die(mysql_error());
$jumlahdata = mysql_num_rows($pagequery);
$maks = ceil($jumlahdata/$baris);
$mulai = $baris * ($hal - 1);
 ?>
<!-- Akhir Paggination -->

<h3>AKTIVITAS OLAHRAGA</h3>
	<?php
	include '../fungsi/koneksi/koneksi.php';
	$username = @$_SESSION['username'];
	$query = mysql_query("SELECT * FROM member WHERE email = '$username'") or die(mysql_error());
	$fecth = mysql_fetch_array($query);
	$data = mysql_query("SELECT * FROM jenisolahraga JOIN instruktur ON jenisolahraga.kodeinstruktur = instruktur.kodeinstruktur ORDER BY kodeolahraga ASC LIMIT $mulai, $baris") or die(mysql_error());
	while ($hasil = mysql_fetch_array($data)) {
		?>
<div class="container cf">
	<table style="border: none;">
	<img src="../gambar/desainweb/<?php echo $hasil['gambar']; ?>" alt="No Image">
		<tr>
			<td><h5>KODE OLAHRAGA</h5></td>
			<td>:</td>
			<td><h5><?php echo $hasil['kodeolahraga']; ?></h5></td>
		</tr>
		<tr>
			<td><h5>AKTIVITAS OLAHRAGA</<h5></h5></td>
			<td>:</td>
			<td><h5><?php echo $hasil['namaolahraga']; ?></h5></td>
		</tr>
		<tr>
			<td><h5>HARGA</<h5></h5></td>
			<td>:</td>
			<td><h5>Rp. <?php echo $hasil['harga']; ?></h5></td>
		</tr>
		<tr>
			<td><h5>Waktu</<h5></h5></td>
			<td>:</td>
			<td><h5><?php echo $hasil['waktu']; ?> - <?php echo $hasil['waktu2']; ?></h5></td>
		</tr>
		<tr>
			<td><h5>Instruktur</<h5></h5></td>
			<td>:</td>
			<td><h5><?php echo $hasil['namalengkap']; ?></h5></td>
		</tr>

		<tr>
			<td><h5>Fasilitas</<h5></h5></td>
			<td>:</td>
			<td><h5><?php echo $hasil['fasilitas']; ?></h5></td>
		</tr>

	</table>
	<button onclick="window.location.href = '?page=pemesanan&kodeolahraga=<?php echo $hasil['kodeolahraga'];?>'" class="pesan">PESAN</button>
</div>
	<?php
	}
	?> 
<table>
		<tr>
			<td style="border: none;">Halaman Ke : <?php for ($i=1; $i <= $maks; $i++) {
				echo"<a href='?page=aktivitasolahraga&hal=$i'>$i  </a>";
		 	} ?></td>
		</tr>
</table>