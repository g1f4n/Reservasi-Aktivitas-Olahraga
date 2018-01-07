<?php 
include '../../fungsi/koneksi/koneksi.php';
$kodebooking = @$_GET['kodebooking'];
$status = 'Aktif';
$query = mysql_query("UPDATE transaksi SET status = '$status' WHERE kodebooking = '$kodebooking'") or die(mysql_error());
if ($query) { ?>
	<script>
	alert('Data Berhasil Di Aktifkan');
	window.location.href = 'halamanadministrator.php?page=lihatdatabooking';
	</script>
	
<?php 
} else { ?>
	<script>alert('Data Gagal Di Aktifkan');</script>
	<meta http-equiv="refresh" content="0;" url="halamanadministrator.php?page=lihatdatabooking">
<?php 
}
 ?>
