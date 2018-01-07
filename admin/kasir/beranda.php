<style>
	.galeri h3 {
		margin-left: 5px;
	}

	.galeri2 h6 {
		text-align: center;
		margin-top: -20px;
	}

	.galeri2 {
		float: left;
	}

	.galeri img {
		width: 340px;
		height: 340px;
		margin: 5px;
		border-radius: 10px;
		box-shadow: 0 0 2px rgba(200,200,200,.3);
	}

	.galeri .edit {
		padding: 10px;
		border-radius: 5px;
		cursor: pointer;
		background-color: dodgerblue;
		color: white;
		width: 340px;
		margin-top: 10px;
	}

	a {
		text-decoration: none;
		margin-left: 5px;
		width: 340px;
	}

</style>
<div class="galeri">
	<h3>Selamat Datang Dihalaman Kasir <?php echo @$_SESSION['nama']; ?></h3>
	<?php 
	$sql = mysql_query("SELECT * FROM gallery") or die(mysql_error()); ?>
	<?php 
	while($data = mysql_fetch_array($sql)) { ?>
	<div class="galeri2">
		<img src="../../gambar/desainweb/<?php echo $data['slide']; ?>" alt="<?php echo $data['kodegallery']; ?>"><br><br>
		<a class="edit" href="edit/editgaleri.php?kodegallery=<?php echo $data['kodegallery']; ?>">Ubah</a>
	</div>
	<?php
	}
	 ?>
</div>