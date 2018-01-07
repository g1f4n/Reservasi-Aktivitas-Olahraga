<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h1>Galeri Foto</h1>
	<div class="containergallery">
		<ul class="gallery cf">
		<?php 
		$sql = mysql_query("SELECT * FROM gallery");
		while ($data = mysql_fetch_array($sql)) { ?>
			<li>
				<a href="#gambar-1">
					<img src="gambar/desainweb/<?php echo $data['slide']; ?>" alt="No Image Result" title="<?php echo $data['kodegallery']; ?>">
					<span><?php echo $data['kodegallery']; ?></span>
				</a>
				<div class="overlay2"></div>
			</li>
		<?php
		}
		 ?>
		</ul>
	</div>
</body>
</html>