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

<h3>Jadwal Aktivitas Anda</h3>
<form action="" method="POST">
	<table>
		<input type="text" name="inputan_pencarian" placeholder="Masukan Kode Pemesanan" style="width: 200px; padding: 5px;">
		<input type="submit" name="cari_aktivitas" value="Cari" style="padding: 3px;"><br><br>
		<tr>
			<th>KODE PEMESANAN</th>
			<th>KODE ANGGOTA</th>
			<th>AKTIVITAS OLAHRAGA</th>
			<th>WAKTU AKTIVITAS</th>
			<th>TANGGAL AKTIVITAS</th>
			<th>INSTRUKTUR</th>
			<th>STATUS</th>
			<th>Total Harga</th>
			<th>OPSI</th>
		</tr>
		<?php 
		$inputan_pencarian = @$_POST['inputan_pencarian'];
		$cari_aktivitas = @$_POST['cari_aktivitas'];
		$kodemember = $_SESSION['kodemember'];
		$sekarang = date('y/m/d');
		date_default_timezone_set('Asia/Jakarta');
		$status1    = 'Proses';
		if ($inputan_pencarian != "") {
			$result     = mysql_query("SELECT * FROM transaksi JOIN (jenisolahraga JOIN instruktur) ON jenisolahraga.kodeinstruktur=instruktur.kodeinstruktur AND transaksi.kodeolahraga=jenisolahraga.kodeolahraga WHERE kodemember = '$kodemember' AND kodebooking LIKE '%$inputan_pencarian%' AND transaksi.tanggal >= '$sekarang'") or die(mysql_error());
		} else {
			$result     = mysql_query("SELECT * FROM transaksi JOIN (jenisolahraga JOIN instruktur) ON jenisolahraga.kodeinstruktur=instruktur.kodeinstruktur AND transaksi.kodeolahraga=jenisolahraga.kodeolahraga WHERE kodemember = '$kodemember' AND transaksi.tanggal >= '$sekarang' ORDER BY kodebooking ASC LIMIT $mulai, $baris") or die(mysql_error());
		}
		$cek = mysql_num_rows($result);
		if ($cek == 0) {
			?><tr>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td><?php echo "Anda Belum Melakukan Reservasi Aktivitas"; ?></td>
			  </tr><?php
		} else {
			while ($data = mysql_fetch_array($result)) { 
				if ($data['status'] == 'Proses' || $data['status'] == 'Booking') { ?>
					<tr>
						<td><?php echo $data['kodebooking']; ?></td>
						<td><?php echo $data['kodemember']; ?></td>
						<td><?php echo $data['namaolahraga']; ?></td>
						<td><?php echo $data['waktu']; ?> - <?php echo $data['waktu2']; ?></td>
						<td><?php echo $data['tanggal']; ?></td>
						<td><?php echo $data['namalengkap']; ?></td>
						<td><?php echo $data['status']; ?></td>
						<?php 
						if ($data['status'] == 'Proses') { ?>
							<td>Rp. <?php echo $data['totalharga']; ?></td>
						<?php
						} else { ?>
							<td>Rp. 0</td>
						<?php
						}
						 ?>
						<td>
								<a href="?page=jadwalulang&kodebooking=<?php echo $data['kodebooking']; ?>"><i class="fa fa-calendar" title="Jadwal Ulang"></i></a>
								<a href="../admin/administrator/hapus/hapuspesanan.php?kodebooking=<?php echo $data['kodebooking']; ?>"><i class="fa fa-trash" title="Batal Pesan"></i></a>
							<?php
							if ($data['status'] == 'Proses') { ?>
								<a hidden href=""><i class="fa fa-print"></i></a>
							<?php
							} else { ?>
								<a target="_BLANK" href="laporan/cetak-booking.php?kodebooking=<?php echo $data['kodebooking']; ?>"><i class="fa fa-print" title="Cetak"></i></a>
							<?php
							}
							?>
						</td>
					</tr>
			<?php
				}
			}
		}
		?>
	</table>
	<table>
		<tr>
			<td style="border: none;">Halaman Ke : <?php for ($i=1; $i <= $maks; $i++) {
				echo"<a href='?page=lihataktivitas&hal=$i'>$i  </a>";
		 	} ?></td>
		</tr>
	</table>
	<p style="margin-top: 10px;"><b>Catatan : Harap Membawa Bukti Pemesanan Pada Saat Melakukan Aktivitas</b></p>
</form>
