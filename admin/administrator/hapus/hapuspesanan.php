<?php 
include '../../../fungsi/koneksi/koneksi.php';
$kodebooking = @$_GET['kodebooking'];
$query = mysql_query("DELETE FROM transaksi WHERE kodebooking = '$kodebooking'") or die(mysql_error());
if ($query) { ?>
	<script>
	alert('Data Berhasil Di Hapus');
	window.location.href = '../../../user/halamanuser.php?page=lihatdataaktivitasolahraga';
	</script>
	
<?php 
} else { ?>
	<script>alert('Data Gagal Dihapus');</script>
	<meta http-equiv="refresh" content="0;" url="halamanadministrator.php?page=lihatdataaktivitasolahraga">
<?php 
}
 ?>
