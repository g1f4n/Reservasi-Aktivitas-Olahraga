<?php 
include '../../../fungsi/koneksi/koneksi.php';
$kodekonfirmasi = @$_GET['kodekonfirmasi'];
$query = mysql_query("DELETE FROM konfirmasi WHERE kodekonfirmasi = '$kodekonfirmasi'") or die(mysql_error());
if ($query) { 
	mysql_query("UPDATE transaksi SET status = 'Proses'") or die(mysql_error()); ?>

	<script>
	alert('Data Berhasil Di Hapus');
	window.location.href = '../halamanpetugas.php?page=lihatdatakonfirmasi';
	</script>
	
<?php 
} else { ?>
	<script>alert('Data Gagal Dihapus');</script>
	<meta http-equiv="refresh" content="0;" url="halamanpetugas.php?page=lihatdatamember">
<?php 
}
 ?>
