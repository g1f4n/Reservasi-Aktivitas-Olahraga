<?php 
include '../../../fungsi/koneksi/koneksi.php';
$kodeolahraga = @$_GET['kodeolahraga'];
$query = mysql_query("DELETE FROM jenisolahraga WHERE kodeolahraga = '$kodeolahraga'") or die(mysql_error());
if ($query) { ?>
	<script>
	alert('Data Berhasil Di Hapus');
	window.location.href = '../halamanadministrator.php?page=lihatdataaktivitasolahraga';
	</script>
	
<?php 
} else { ?>
	<script>alert('Data Gagal Dihapus');</script>
	<meta http-equiv="refresh" content="0;" url="halamanadministrator.php?page=lihatdataaktivitasolahraga">
<?php 
}
 ?>
