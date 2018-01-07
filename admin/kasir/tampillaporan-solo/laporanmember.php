<?php 
require_once('../../../dompdf/dompdf_config.inc.php');
include '../../../fungsi/koneksi/koneksi.php';

$kodemember   = @$_GET['kodemember'];
$sql          = mysql_query("SELECT * FROM member WHERE kodemember = '$kodemember'") or die(mysql_error());
$data         = mysql_fetch_array($sql);

$kodemember   = $data['kodemember'];
$namalengkap  = $data['namalengkap'];
$jeniskelamin = $data['jeniskelamin'];
$telp         = $data['telp'];
$alamat       = $data['alamat'];
$gambar       = $data['gambar'];
$email        = $data['email'];

$html = 
		'<html><body>'.
		'<center><h1>Laporan Data Anggota </h1></center>'.
		'<table width="70%" align="center">
			<tr>
				<th>Kode Anggota"'.$kodemember.'"</th>
			</tr>'.
			'<tr>
				<td>Nama Lengkap</td>
				<td>'.$namalengkap.'</td>
			</tr>'.
			'<tr>
				<td>Jenis Kelamin</td>
				<td>'.$jeniskelamin.'</td>
			</tr>'.
			'<tr>
				<td>Nomor Telepon</td>
				<td>'.$telp.'</td>
			</tr>'.
			'<tr>
				<td>Alamat</td>
				<td>'.$alamat.'</td>
			</tr>'.
			'<tr>
				<td>Gambar</td>
				<td><img style="width:120px; height=120px;" src="../../../gambar/foto/'.$gambar.'"></td>
			</tr>'.
			'<tr>
				<td>Email</td>
				<td>'.$email.'</td>
			</tr>'.
		'</table>
		</body></html>';

$dompdf = new dompdf();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream('Laporan_Data_Member_'.$namalengkap.'.pdf',array('Attachment'=>0));
 ?>