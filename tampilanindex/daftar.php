<div class="daftar">
	<form action="aksi/prosesdaftar.php" id="daftar" method="POST" enctype="multipart/form-data" onsubmit=" return cekData();">
		<table>
			<h2>Daftar Anggota</h2><hr>
			<tr>
				<td><label for="kodemember">Kode Anggota</label></td>
			</tr>
			<tr>
				<td><input class="inputRegis" type="text" name="kodemember" id="kodemember" value="<?php
					$carikode = mysql_query("SELECT MAX(kodemember) FROM member") or die(mysql_error());
					$datakode = mysql_fetch_array($carikode);
					if ($datakode) {
					$nilaikode = substr($datakode[0], 1);
					$kode = (int) $nilaikode;
					$kode = $kode + 1;
					$hasilkode = printf("%04s", $kode);
					} else {
					$hasilkode = "Member Tidak Terdaftar";
					}
				?>" readonly></td>
			</tr>

			<tr>
				<td><label for="nama">Nama Lengkap</label></td>
			</tr>
			<tr>
				<td><input class="inputRegis" maxlength="40" type="text" name="nama" id="nama" placeholder="Masukan Nama Lengkap"></td>
			</tr>

			<tr>
				<td><label for="jk">Jenis Kelamin</label></td>
			</tr>
			<tr>
				<td>
					<label><input type="radio" name="jk" value="Laki-Laki"/> Laki - Laki</label>
					<label><input type="radio" name="jk" value="Perempuan"/> Perempuan</label>
				</td>
			</tr>

			<tr>
				<td><label for="telp">Nomor Telepon</label></td>
			</tr>
			<tr>
				<td><input class="inputRegis" maxlength="12" type="text" name="telp" id="telp" placeholder="Masukan Nomor Telepon Anda"></td>
			</tr>

			<tr>
				<td><label for="alamat">Alamat</label></td>
			</tr>
			<tr>
				<td><textarea name="alamat" id="alamat" cols="30" rows="10" placeholder="Masukan Alamat Anda"></textarea></td>
			</tr>

			<tr>
				<td><label for="email">Email</label></td>
			</tr>
			<tr>
				<td><input class="inputRegis" maxlength="50" type="text" name="email" id="email" placeholder="Masukan Alamat Email Anda"></td>
			</tr>

			<tr>
				<td><label for="password">Kata Sandi</label></td>
			</tr>
			<tr>
				<td><input class="inputRegis" maxlength="40" type="password" name="password" id="password" placeholder="Masukan Kata Sandi Anda"></td>
			</tr>

			<tr>
				<td><label for="gambar">Foto</label></td>
			</tr>
			<tr>
				<td><input class="inputRegis" type="file" name="gambar" id="gambar"></td>
			</tr>

			<tr>
				<td><input id="submit" class="btn btn-send" type="submit" name="submit" value="Kirim"></td>
			</tr>
		</table>
	</form>
</div>