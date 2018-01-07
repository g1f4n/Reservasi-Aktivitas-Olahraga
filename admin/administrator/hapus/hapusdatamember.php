<?php 
include '../../../fungsi/koneksi/koneksi.php';
$kodemember = @$_GET['kodemember'];
$query = mysql_query("DELETE FROM member WHERE kodemember = '$kodemember'") or die(mysql_error());
if ($query) { ?>
	<script>
	alert('Data Berhasil Di Hapus');
	window.location.href = '../halamanadministrator.php?page=lihatdatamember';
	</script>
	
<?php 
} else { ?>
	<script>alert('Data Gagal Dihapus');</script>
	<meta http-equiv="refresh" content="0;" url="halamanadministrator.php?page=lihatdatamember">
<?php 
}
 ?>
