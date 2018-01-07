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
<form action="" method="POST">
<h3>Konfirmasi Pemesanan</h3>
<table>
		<input type="text" name="inputan_pencarian" placeholder="Masukan Kode Pemesanan" style="width: 200px; padding: 5px;">
		<input type="submit" name="cari_aktivitas" value="Cari" style="padding: 3px;"><br><br>
		<tr>
			<th>Kode Pemesanan</th>
			<th>WAKTU AKTIVITAS</th>
			<th>Nama Lengkap</th>
			<th>Aktivitas Olahraga</th>
			<th>Tanggal Aktivitas</th>
			<th>Bukti Bayar</th>
			<th>Status</th>
			<th>OPSI</th>
		</tr>
		<?php 
		$status = 'Proses';
		$kodemember = $_SESSION['kodemember'];
		$sekarang = date('y/m/d');
		date_default_timezone_set('Asia/Jakarta');
		$inputan_pencarian = @$_POST['inputan_pencarian'];
		$cari_aktivitas = @$_POST['cari_aktivitas'];
		if ($inputan_pencarian != "") {
			$result = mysql_query("SELECT * FROM transaksi JOIN (member JOIN jenisolahraga) ON transaksi.kodemember = member.kodemember AND transaksi.kodeolahraga = jenisolahraga.kodeolahraga WHERE transaksi.kodemember = '$kodemember' AND status = '$status' AND kodebooking LIKE '%$inputan_pencarian%' AND transaksi.tanggal >= '$sekarang'") or die(mysql_error());
		} else {
			$result = mysql_query("SELECT * FROM transaksi JOIN (member JOIN jenisolahraga) ON transaksi.kodemember = member.kodemember AND transaksi.kodeolahraga = jenisolahraga.kodeolahraga WHERE transaksi.kodemember = '$kodemember' AND status = '$status' AND transaksi.tanggal >= '$sekarang' ORDER BY kodebooking ASC LIMIT $mulai, $baris") or die(mysql_error());
		}
		$cek = mysql_num_rows($result);
		if ($cek == 0) {
			?><tr>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td colspan="2"><?php echo "Anda Belum Melakukan Reservasi Aktivitas"; ?></td>
			  </tr><?php
		} else {
			while ($data = mysql_fetch_array($result)) { ?>
		<tr>
			<td><?php echo $data['kodebooking']; ?></td>
			<td><?php echo $data['waktu']; ?> - <?php echo $data['waktu2']; ?></td>
			<td><?php echo $data['namalengkap']; ?></td>
			<td><?php echo $data['namaolahraga']; ?></td>
			<td><?php echo $data['tanggal']; ?></td>
			<td><img src="../gambar/foto/<?php echo $data['buktibayar']; ?>" alt="Tidak ada Gambar	"></td>
			<td><?php echo $data['status']; ?></td>
			<td>
				<a href="?page=konfirmasiaktivitas&kodebooking=<?php echo $data['kodebooking']; ?>">Konfirmasi</a>
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
				echo"<a href='?page=konfirmasibooking&hal=$i'>$i  </a>";
		 	} ?></td>
		</tr>
</table>
</form>