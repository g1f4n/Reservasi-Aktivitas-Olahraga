<?php 
include '../../../fungsi/koneksi/koneksi.php';
$kodeinstruktur = @$_GET['kodeinstruktur'];
$query = mysql_query("DELETE FROM instruktur WHERE kodeinstruktur = '$kodeinstruktur'") or die(mysql_error());
if ($query) { ?>
	<script>
	alert('Data Berhasil Di Hapus');
	window.location.href = '../halamanadministrator.php?page=lihatdatainstruktur';
	</script>
	
<?php 
} else { ?>
	<script>alert('Data Gagal Dihapus');</script>
	<meta http-equiv="refresh" content="0;" url="halamanadministrator.php?page=lihatdatainstruktur">
<?php 
}
 ?>
