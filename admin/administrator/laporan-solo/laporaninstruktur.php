<?php 
require_once('../../../dompdf/dompdf_config.inc.php');
include '../../../fungsi/koneksi/koneksi.php';
$kodeinstruktur = $_GET['kodeinstruktur'];
$sql = mysql_query("SELECT * FROM instruktur WHERE kodeinstruktur = '$kodeinstruktur'") or die(mysql_error());
$data = mysql_fetch_array($sql);

$html = '<html><body style ="backgournd-image:(../../../gambar/desainweb/Sports.png);">'.
		'<center><h1>Laporan Data Instruktur </h1></center>'.
		'<table>
			<tr>
				<th>Kode Instruktur '.$data['kodeinstruktur'].'</th>
			</tr>
			<tr>
				<td>Nama Lengkap</td>
				<td>:</td>
				<td>'.$data['namalengkap'].'</td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td>:</td>
				<td>'.$data['jeniskelamin'].'</td>
			</tr>
			<tr>
				<td>Nomor Telepon</td>
				<td>:</td>
				<td>'.$data['telp'].'</td>
			</tr>
			<tr>
				<td>Foto</td>
				<td>:</td>
				<td><img style="width:120px; height:120px;" src="../../../gambar/instruktur/'.$data['gambar1'].'"></td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td>:</td>
				<td>'.$data['alamat'].'</td>
			</tr>
			<tr>
				<td>Email</td>
				<td>:</td>
				<td>'.$data['email'].'</td>
			</tr>
		</table>
		</body></html>';
$dompdf = new dompdf();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream('Laporan_Data'.$data['namalengkap'].'.pdf',array('Attachment'=>0));

 ?>