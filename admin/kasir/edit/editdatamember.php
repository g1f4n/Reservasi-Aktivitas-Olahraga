<h4>Edit Data Anggota</h4>
<form action="" id="daftar" method="POST" enctype="multipart/form-data" onsubmit="return cekData();">
	<table>
	<?php 
	$kodemember = @$_GET['kodemember'];
	$ubahdata = mysql_query("SELECT * FROM member WHERE kodemember = '$kodemember'") or die(mysql_error());
	$hasil = mysql_fetch_array($ubahdata);
	 ?>
		<tr>
			<td>Kode Anggotaa</td>
			<td>:</td>
			<td><input type="text" name="kodemember" value="<?php echo $hasil['kodemember']; ?>" readonly></td>
		</tr>

		<tr>
			<td>Nama Lengkap</td>
			<td>:</td>
			<td><input type="text" name="nama" maxlength="40" value="<?php echo $hasil['namalengkap']; ?>"></td>
		</tr>

		<tr>
			<td>Jenis Kelamin</td>
			<td>:</td>
			<td>
				<label><input class="jeniskelamin" type="radio" name="jk" value="<?php echo $hasil['jeniskelamin']; ?>" <?php if ($hasil['jeniskelamin'] == 'Laki-Laki') {echo "checked";} ?> style="height: auto;" /> Laki - Laki</label>
					<label><input class="jeniskelamin" type="radio" name="jk" value="<?php echo $hasil['jeniskelamin']; ?>" <?php if ($hasil['jeniskelamin'] == 'Perempuan') {echo "checked";} ?> style="height: auto;" /> Perempuan</label>
			</td>
		</tr>

		<tr>
			<td>Nomor Telepon</td>
			<td>:</td>
			<td><input type="text" name="telp" maxlength="12" value="<?php echo $hasil['telp']; ?>"></td>
		</tr>
		
		<tr>
			<td>Alamat</td>
			<td>:</td>
			<td><textarea name="alamat" id="alamat" cols="30" rows="10"><?php echo $hasil['alamat']; ?></textarea></td>
		</tr>

		<tr>
			<td>Email</td>
			<td>:</td>
			<td><input type="text" name="email" maxlength="50" value="<?php echo $hasil['email']; ?>"></td>
		</tr>

		<tr>
			<td>Kata Sandi</td>
			<td>:</td>
			<td><input type="password" maxlength="40" name="password" value="*****"></td>
		</tr>

		<tr>
			<td>Foto</td>
			<td>:</td>
			<td><img style="width: 60px; height: 60px;" src="../../gambar/foto/<?php echo $hasil['gambar']; ?>" alt=""></td>
			<tr>
				<td></td>
				<td></td>
				<td><input style="border: none;" type="file" name="gambar" id="gambar" value="<?php echo $hasil['gambar']; ?>"></td>
			</tr>
		</tr>

		<tr>
			<td></td>
			<td></td>
			<td><input id="edit" type="submit" name="edit" value="Ubah"></td>
		</tr>
	</table>
	<?php 
		$kodemember   = @$_POST['kodemember'];
		$nama         = @$_POST['nama'];
		$jk           = @$_POST['jk'];
		$telp         = @$_POST['telp'];
		$alamat       = @$_POST['alamat'];
		
		$sumber       = @$_FILES['gambar']['tmp_name'];
		$target       = '../../gambar/foto/';
		$nama_gambar  = @$_FILES['gambar']['name'];
		
		$email        = @$_POST['email'];
		$password     = @$_POST['password'];
		$passwordlama = $hasil['password'];
		$imageFileType = pathinfo($nama_gambar, PATHINFO_EXTENSION);	 

		if (@$_POST['edit']) {
			if ($nama_gambar == ""){mysql_query("UPDATE member SET namalengkap = '$nama', jeniskelamin = '$jk', telp = '$telp', alamat = '$alamat', email = '$email', password = '$passwordlama' WHERE kodemember='$kodemember'") or die(mysql_error());
			?><script>
				alert('Data Berhasil Di Ubah');
				window.location.href ='halamanpetugas.php?page=lihatdatamember'
			</script><?php
			} else if ($imageFileType != 'jpg' && $imageFileType != 'jpeg' && $imageFileType != 'png') { ?>
				<script>
					alert('Foto Yang Di Izinkan Hanya Ekstensi .jpg atau .png');
				</script>
			<?php
			} else {
				$pindah = move_uploaded_file($sumber, $target.$nama_gambar);
				if ($pindah) {
					if ($password == '*****') {
						mysql_query("UPDATE member SET namalengkap = '$nama', jeniskelamin = '$jk', telp = '$telp', alamat = '$alamat', gambar = '$nama_gambar', email = '$email', password = '$passwordlama' WHERE kodemember='$kodemember'") or die(mysql_error());
						?><script>
							alert('Data Berhasil Di Ubah');
							window.location.href = 'halamanpetugas.php?page=lihatdatamember';
						</script><?php
					} else {
						mysql_query("UPDATE member SET namalengkap = '$nama', jeniskelamin = '$jk', telp = '$telp', alamat = '$alamat', gambar = '$nama_gambar', email = '$email', password = md5('$password') WHERE kodemember='$kodemember'") or die(mysql_error());
						?><script>
							alert('Data Berhasil Di Ubah');
							window.location.href = 'halamanpetugas.php?page=lihatdatamember';
						</script><?php
					}
				} else if ($password != '*****' && $nama_gambar == '') {
					mysql_query("UPDATE member SET namalengkap = '$nama', jeniskelamin = '$jk', telp = '$telp', alamat = '$alamat', email = '$email', password = md5('$password') WHERE kodemember='$kodemember'") or die(mysql_error());
						?><script>
							alert('Data Berhasil Di Ubah');
							window.location.href = 'halamanpetugas.php?page=lihatdatamember';
						</script><?php
				}
			}
		}
	?>
</form>