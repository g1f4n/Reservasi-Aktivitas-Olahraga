<?php 
$baris = 3;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 1;
$pagesql = "SELECT * FROM member";
$pagequery = mysql_query($pagesql) or die(mysql_error());
$jumlahdata = mysql_num_rows($pagequery);
$maks = ceil($jumlahdata/$baris);
$mulai = $baris * ($hal - 1);
 ?>
<form action="" method="POST">
<table class="tabel2">
	<h4>Data Anggota</h4>
	<input type="text" name="inputan_pencarian" placeholder="Masukan Kode Anggota / Nama Anggota" style="width: 200px; padding: 5px; margin-left: 10px;">
	<input type="submit" name="cari_aktivitas" value="Cari" style="padding: 3px;">
	<tr>
		<th>Kode Anggota</th>
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
		$sql = mysql_query("SELECT * FROM member WHERE kodemember LIKE '%$inputan_pencarian%' OR namalengkap LIKE '%$inputan_pencarian%'") or die(mysql_error());
	} else {
		$sql = mysql_query("SELECT * FROM member LIMIT $mulai, $baris") or die(mysql_error());
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
		$no = $mulai;
		while ($data = mysql_fetch_array($sql)) { 
		$no++;
		 ?>
			<tr>
				<td class="tampilan"><?php echo $data['kodemember']; ?></td>
				<td class="tampilan"><?php echo $data['namalengkap']; ?></td>
				<td class="tampilan"><?php echo $data['jeniskelamin']; ?></td>
				<td class="tampilan"><?php echo $data['telp']; ?></td>
				<td class="tampilan"><?php echo $data['alamat']; ?></td>
				<td class="tampilan"><?php echo $data['email']; ?></td>
				<?php 
				if ($data['gambar'] == '') { ?>
				<td class="tampilan"><img style="width: 60px; height: 60px;" src="../../gambar/foto/default.jpg" alt="Tidak Ada Foto"></td>
				<?php
				} else { ?>
				<td class="tampilan"><img style="width: 60px; height: 60px;" src="../../gambar/foto/<?php echo $data['gambar']; ?>" alt="Tidak Ada Foto"></td>
				<?php
				}
				 ?>
				<td class="tampilan">
					<a href="?page=editdatamember&kodemember=<?php echo $data['kodemember']; ?>"><i class="fa fa-edit" title="Edit"></i></a>
					<a href="hapus/hapusdatamember.php?kodemember=<?php echo $data['kodemember']; ?>" onclick="return confirm('Anda Yakin Ingin Menghapus Data?');"><i class="fa fa-trash-o" title="Hapus"></i></a>
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
			echo"<a href='?page=lihatdatamember&hal=$i'>$i  </a>";
	 	} ?></td>
	</tr>
</table>
</form>