<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body style="border-image: url('../../../gambar/desainweb/Sports.png');">
	<form action="" method="POST" enctype="multipart/form-data">
		<?php 
		include '../../../fungsi/koneksi/koneksi.php';
		$kodegallery = $_GET['kodegallery'];
		$sql = mysql_query("SELECT * FROM gallery WHERE kodegallery = '$kodegallery'") or die(mysql_error());
		$result = mysql_fetch_array($sql);
		 ?>
		<img src="../../../gambar/desainweb/<?php echo $result['slide']; ?>" alt="" style="height: 400px; width: 100%;"><br>
		<input type="file" name="edit-gambar" value="<?php echo $result['slide']; ?>"><br>
		<input type="submit" name="edit" value="Ubah">
	</form>
	<?php
	$sumber      = @$_FILES['edit-gambar']['tmp_name'];
	$target      = '../../../gambar/desainweb/';
	$nama_gambar = @$_FILES['edit-gambar']['name'];
	$imageFileType = pathinfo($nama_gambar, PATHINFO_EXTENSION);
	

	if (@$_POST['edit']) {
		if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
				?><script>
					alert('File Yang Di Izinkan Hanya JPG, JPEG, dan PNG');
					window.location.href = '../halamanadministrator.php'
				</script><?php
		} else {
			$pindah = move_uploaded_file($sumber, $target.$nama_gambar);
			if ($pindah) {
				mysql_query("UPDATE gallery SET slide = '$nama_gambar' WHERE kodegallery = '$kodegallery'") or die(mysql_error());
				?><script>
					alert('Data Berhasil Di Ubah');
					window.location.href ='../halamanadministrator.php';
				</script><?php
			}
		}
	}
	?>
</body>
</html>