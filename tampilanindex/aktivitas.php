<div class="instruktur cf">
	<h2>Aktivitas Olahraga</h2><hr>
	<?php 
	include 'fungsi/koneksi/koneksi.php';
	$result = mysql_query("SELECT * FROM jenisolahraga") or die(mysql_error());
	$cek = mysql_num_rows($result);
	if ($cek == 0) {
		?><h6 style="text-align: center;">Data Tidak Ditemukan</h6><?php
	} else {
		while ($data = mysql_fetch_array($result)) { ?>
		<div class="instruktur2">
			<h5><?php echo $data['namaolahraga']; ?></h5>
			<h6><?php echo "Rp.".$data['harga']."/Pertemuan"; ?></h6>
			<img title="Klik Untuk Memesan Aktivitas" src="gambar/desainweb/<?php echo $data['gambar']; ?>" alt="No Image Result" title="<?php echo $data['namaolahraga']; ?>">
		</div>
		<?php }
	}
	
	 ?>
</div>