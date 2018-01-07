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
<table class="tabel2">
	<h4>Data Booking</h4>
	<tr>
		<th>Kode Booking</th>
		<th>Kode Member</th>
		<th>Aktivitas Olahraga</th>
		<th>Instruktur</th>
		<th>Tanggal Pemakaian</th>
		<th>Waktu</th>
		<th>Jumlah Orang</th>
		<th>Status</th>
		<th>Aksi</th>
	</tr>

	<?php 
	$sql = mysql_query("SELECT * FROM transaksi JOIN (member JOIN jenisolahraga JOIN instruktur) ON transaksi.kodemember = member.kodemember AND transaksi.kodeolahraga = jenisolahraga.kodeolahraga AND jenisolahraga.kodeinstruktur = instruktur.kodeinstruktur ORDER BY kodebooking ASC LIMIT $mulai, $baris") or die(mysql_error());
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
						<a href="?page=editdatabooking&kodebooking=<?php echo $data['kodebooking']; ?>"><i class="fa fa-edit" title="edit"></i></a>
						<a href="hapus/hapusdatabooking.php?kodebooking=<?php echo $data['kodebooking']; ?>" onclick="return confirm('Data Berhasil Di Hapus?');"><i class="fa fa-trash-o" title="Hapus"></i></a>
						<?php 
						if ($data['status'] == 'Proses') { ?>
							<a hidden href="?page=ubahdatabooking&kodebooking=<?php echo $data['kodebooking']; ?>"><i class="fa fa-check" title="Aktifkan"></i></a>
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
			echo"<a href='?page=lihatdatabooking&hal=$i'>$i  </a>";
	 	} ?></td>
	</tr>
</table>
</form>