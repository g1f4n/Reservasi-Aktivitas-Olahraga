<h4>Tambah Data Anggota</h4>
<form id="daftar" action="" method="POST" enctype="multipart/form-data" onsubmit="return cekData();">
	<table>
		<tr>
			<td>Kode Anggota</td>
			<td>:</td>
			<td><input type="text" name="kodemember" value="<?php
					$carikode = mysql_query("SELECT MAX(kodemember) FROM member") or die(mysql_error());
					$datakode = mysql_fetch_array($carikode);
					if ($datakode) {
					$nilaikode = substr($datakode[0], 1);
					$kode = (int) $nilaikode;
					$kode = $kode + 1;
					$hasilkode = printf("%04s", $kode);
					} else {
					$hasilkode = "Anggota Tidak Terdaftar";
					}
				?>"></td>
		</tr>

		<tr>
			<td>Nama Lengkap</td>
			<td>:</td>
			<td><input type="text" name="nama" maxlength="40" id="nama"></td>
		</tr>

		<tr>
			<td>Jenis Kelamin</td>
			<td>:</td>
			<td>
				<label><input class="jeniskelamin" type="radio" name="jk" value="Laki-Laki" style="height: auto;" /> Laki - Laki</label>
				<label><input class="jeniskelamin" type="radio" name="jk" value="Perempuan" style="height: auto;" /> Perempuan</label>
			</td>
		</tr>

		<tr>
			<td>Nomor Telepon</td>
			<td>:</td>
			<td><input type="text" name="telp" maxlength="12" id="telp"></td>
		</tr>

		<tr>
			<td>Alamat</td>
			<td>:</td>
			<td><textarea name="alamat" id="alamat" cols="30" rows="10"></textarea></td>
		</tr>

		<tr>
			<td>Email</td>
			<td>:</td>
			<td><input type="text" name="email" maxlength="50" id="email"></td>
		</tr>

		<tr>
			<td>Kata Sandi</td>
			<td>:</td>
			<td><input type="password" name="password" maxlength="40" id="password"></td>
		</tr>

		<tr>
			<td>Foto</td>
			<td>:</td>
			<td><input style="border: none;" type="file" name="gambar" id="gambar"></td>
		</tr>

		<tr>
			<td></td>
			<td></td>
			<td><input id="edit" type="submit" name="tambah" value="Kirim"></td>
		</tr>
	</table>
<!-- Akhir Kerangka Body -->

<!-- Fungsi Simpan Data -->
<?php 

		$kodemember  = @$_POST['kodemember'];
		$nama        = @$_POST['nama'];
		$jk          = @$_POST['jk'];
		$telp        = @$_POST['telp'];
		$alamat      = @$_POST['alamat'];
		$username    = @$_POST['email'];
		$password    = md5(@$_POST['password']);
		
		$sumber      = @$_FILES['gambar']['tmp_name'];
		$target      = '../../gambar/foto/';
		$kosong      = "";
		$nama_gambar = @$_FILES['gambar']['name'];
		$imageFileType = pathinfo($nama_gambar, PATHINFO_EXTENSION);
		
		$daftar      = @$_POST['tambah'];
		
		$sql         = mysql_query("SELECT * FROM member WHERE email = '$username'") or die(mysql_error());
		$cek         = mysql_num_rows($sql);
		$data        = mysql_fetch_array($sql);

		if ($daftar) {
			if ($cek >= 1) {
				?><script>
				alert('Alamat Email Sudah Ada');
				window.location.href='halamanpetugas.php?page=tambahdatamember';
				</script><?php  
			} else if ($nama_gambar == '') {
				mysql_query("INSERT INTO member VALUES('$kodemember', '$nama', '$jk', '$telp', '$alamat', '$kosong' , '$username', '$password')") or die(mysql_error());
					?><script>
						alert('Data Berhasil Disimpan');
						window.location.href='halamanpetugas.php?page=lihatdatamember';
					</script><?php
			} else if ($imageFileType != 'jpg' && $imageFileType != 'jpeg' && $imageFileType != 'png') { ?>
				<script>
					alert('Foto Yang Di Izinkan Hanya Ekstensi .jpg atau .png');
					window.location.href = 'halamanpetugas.php?page=tambahdatamember';
				</script>
			<?php
			} else($pindah = move_uploaded_file($sumber, $target.$nama_gambar)); {
				if ($pindah) {
					mysql_query("INSERT INTO member VALUES('$kodemember', '$nama', '$jk', '$telp', '$alamat', '$nama_gambar' , '$username', '$password')") or die(mysql_error());
					?><script>
						alert('Data Berhasil Disimpan');
						window.location.href='halamanpetugas.php?page=lihatdatamember';
					</script><?php
				} else {
					?><script>
						alert('Gambar Gagal Upload');
						window.location.href='halamanpetugas.php?page=tambahdatamember';
					</script><?php
				} 
			} 
		}
	?>
<!-- Akhir Fungsi Simpan Data -->
</form>