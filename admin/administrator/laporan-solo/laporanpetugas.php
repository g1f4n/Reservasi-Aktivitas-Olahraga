<?php 
require_once('../../../dompdf/dompdf_config.inc.php');
include '../../../fungsi/koneksi/koneksi.php';
$kodeuser = $_GET['kodeuser'];
$sql = mysql_query("SELECT * FROM admin WHERE kodeuser = '$kodeuser'") or die(mysql_error());
$data = mysql_fetch_array($sql);

$html = '<html><body style ="backgournd-image:(../../../gambar/desainweb/Sports.png);">'.
		'<center><h1>Laporan Data admin </h1></center>'.
		'<table>
			<tr>
				<th>Kode admin '.$data['kodeuser'].'</th>
			</tr>
			<tr>
				<td>Nama Lengkap</td>
				<td>:</td>
				<td>'.$data['nama'].'</td>
			</tr>
			<tr>
				<td>Nama Pengguna</td>
				<td>:</td>
				<td>'.$data['username'].'</td>
			</tr>
			<tr>
				<td>Level</td>
				<td>:</td>
				<td>'.$data['level'].'</td>
			</tr>
		</table>
		</body></html>';
$dompdf = new dompdf();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream('Laporan_Data'.$data['nama'].'.pdf',array('Attachment'=>0));

 ?>