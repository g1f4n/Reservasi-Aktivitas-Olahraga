
// validasi Kalau Inputan Kosong, Harus Angka, Minimal Karakter, email, upload foto
function cekData() {
	// Validasi Nama Harus Huruf
	var harusHuruf = /^[a-zA-Z ]+$/;
	// Validasi Nama Harus Huruf
	
	// Validasi Email harus ada karakter @ dan .
	var pola_email = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
	// Akhir Validasi Email harus ada karakter @ dan .

	// Validasi Nomor Telepon harus Angka
	var nomor_telepon = document.forms["daftar"]["telp"].value;
	var nomor = /^[0-9]+$/;
	// Akhir Validasi Nomor Telepon harus Angka

	// Validasi Gambar 
		// Gambar Yang Di izinkan Hanya format Jpg, Jpeg dan Png
		// var inputFile = document.getElementById('gambar');
		// var pathFile = inputFile.value;
		// var extensi = /(\.jpg | \.jpeg | \.png)$/i;
		// Akhir Gambar Yang Di izinkan Hanya format Jpg, Jpeg dan Png

		// Gambar Maksimal 2 MegaByte
		var fileSize = document.getElementById("gambar").files[0];
		// Akhir Gambar Maksimal 2 MegaByte
	// Akhir Validasi Gambar


	if (daftar.nama.value === "" && daftar.jk.value === "" && daftar.telp.value === "" && daftar.alamat.value === "" && daftar.email.value === "" && daftar.password.value === "") {
		alert('Harap Melengkapi Data Yang Masih Kosong!!!');
		daftar.nama.focus();
		return false;
	} if (daftar.nama.value === "") {
		alert('Inputan Nama Lengkap Tidak Boleh Kosong');
		daftar.nama.focus();
		return false;
	} if (!harusHuruf.test(daftar.nama.value)) {
		alert('Inputan Nama Lengkap Hanya Di Izinkan Huruf!!!');
		daftar.nama.focus();
		return false;
	} if (daftar.jk.value == '') {
			alert('Silahkan Pilih Jenis kelamin Terlebih Dahulu');
			return false;
	} if (nomor_telepon === "" || nomor_telepon === null) {
		alert("Inputan Nomor Telepon Tidak Boleh Kosong!!!");
		daftar.telp.focus();
		return false;
	} if (!nomor_telepon.match(nomor)) {
		alert("Inputan Nomor Telepon Hanya Di Izinkan Angka!!!");
		daftar.telp.focus();
		return false;
	} if (daftar.alamat.value === "") {
		alert("Inputan Alamat Tidak Boleh Kosong!!!");
		daftar.alamat.focus();
		return false;
	} if (daftar.email.value === "") {
		alert("Inputan Email Tidak Boleh Kosong!!!");
		daftar.email.focus();
		return false;
	} if (!pola_email.test(daftar.email.value)) {
			alert('Inputan Email Anda Salah Atau Kurang Lengkap, Contoh@gmail.com');
			daftar.email.focus();
			return false;
	} if (daftar.password.value === "") {
		alert("Inputan Kata Sandi Tidak Boleh Kosong!!!");
		daftar.password.focus();
		return false;
	//} if (!extensi.exec(pathFile)) {
		//alert(".jpeg, .jpg, .png Only Accepted");
		//return false;
	} if (fileSize.size > 2097152) {
		alert("Foto Yang Di Unggah Maksimal 2 MegaByte");
		return false;
	} else {
		return true;
	}
}
// Akhir validasi Kalau Inputan Kosong, Harus Angka, Minimal Karakter, email, upload foto