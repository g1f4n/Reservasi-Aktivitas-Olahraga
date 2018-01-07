<div class="instruktur cf">
	<h2>Instruktur</h2><hr>
	<?php 
	include 'fungsi/koneksi/koneksi.php';
	$result = mysql_query("SELECT * FROM instruktur") or die(mysql_error());
	$cek = mysql_num_rows($result);
	if ($cek == 0) {
		?><h6>Data Tidak Ditemukan</h6><?php
	} else {
		while ($data = mysql_fetch_array($result)) { ?>
		<div class="instruktur2">
			<h6><?php echo $data['namalengkap']; ?></h6>
			<img src="gambar/instruktur/<?php echo $data['gambar1']; ?>" alt="No Image Result" title="">
		</div>
		<?php }
	}
	
	 ?>
</div>