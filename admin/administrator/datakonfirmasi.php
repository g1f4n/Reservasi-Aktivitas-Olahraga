<?php 
// $baris = 3;
// $hal = isset($_GET['hal']) ? $_GET['hal'] : 1;
// $pagesql = "SELECT * FROM konfirmasi";
// $pagequery = mysql_query($pagesql) or die(mysql_error());
// $jumlahdata = mysql_num_rows($pagequery);
// $maks = ceil($jumlahdata/$baris);
// $mulai = $baris * ($hal - 1);
 ?>

<form action="" method="POST">
<table class="tabel2">
	<h4>Data Konfirmasi</h4>
	<tr>
		<th>Kode Konfirmasi</th>
		<th>Kode Member</th>
		<th>Kode Booking</th>
		<th>Nama Lengkap</th>
		<th>Aktivitas Olahraga</th>
		<th>Tanggal Aktivitas</th>
		<th>Waktu</th>
		<th>Bukti Bayar</th>
		<th>Aksi</th>
	</tr>

	<?php 
	$sql = mysql_query("SELECT * FROM konfirmasi JOIN (transaksi JOIN member JOIN jenisolahraga) ON konfirmasi.kodebooking = transaksi.kodebooking AND konfirmasi.kodemember = member.kodemember AND transaksi.kodeolahraga = jenisolahraga.kodeolahraga WHERE status = 'Booking'") or die(mysql_error());
	$cek = mysql_num_rows($sql);

	if ($cek == 0) { ?>
		<tr>
			<td><?php echo "Data Tidak Ditemukan"; ?></td>
		</tr>
	<?php
	} else {
		while ($data = mysql_fetch_array($sql)) { ?>
			<tr>
				<td class="tampilan"><?php echo $data['kodekonfirmasi']; ?></td>
				<td class="tampilan"><?php echo $data['kodemember']; ?></td>
				<td class="tampilan"><?php echo $data['kodebooking']; ?></td>
				<td class="tampilan"><?php echo $data['namalengkap']; ?></td>
				<td class="tampilan"><?php echo $data['namaolahraga']; ?></td>
				<td class="tampilan"><?php echo $data['tanggal']; ?></td>
				<td class="tampilan"><?php echo $data['waktu']; ?> - <?php echo $data['waktu2']; ?></td>
				<td class="tampilan"><img style="width: 100px; height: 100px;" src="../../gambar/foto/<?php echo $data['buktibayar']; ?>"></td>
				<td class="tampilan">
					<a href="hapus/hapusdatakonfirmasi.php?kodekonfirmasi=<?php echo $data['kodekonfirmasi']; ?>" onclick="return confirm('Anda Yakin Ingin Menghapus Data?');"><i class="fa fa-trash" title="Hapus"></i></a>
					<a href="?page=ubahdatabooking&kodebooking=<?php echo $data['kodebooking']; ?>"><i class="fa fa-check" title="Cetak"></i></a>
				</td>
			</tr>
		<?php
		}
	}
	?>
</table>
</form>