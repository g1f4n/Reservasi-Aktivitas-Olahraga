<?php 
include '../../../fungsi/koneksi/koneksi.php';
$kodeuser = @$_GET['kodeuser'];
$query = mysql_query("DELETE FROM admin WHERE kodeuser = '$kodeuser'") or die(mysql_error());
if ($query) { ?>
	<script>
	alert('Data Berhasil Di Hapus');
	window.location.href = '../halamanadministrator.php?page=lihatdatapegtugas';
	</script>
	
<?php 
} else { ?>
	<script>alert('Data Gagal Dihapus');</script>
	<meta http-equiv="refresh" content="0;" url="?page=lihatdatapegtugas">
<?php 
}
 ?>
