<?php 
require_once('../../../dompdf/dompdf_config.inc.php');
include '../../../fungsi/koneksi/koneksi.php';
$kodeolahraga = $_GET['kodeolahraga'];
$sql = mysql_query("SELECT * FROM jenisolahraga jOIN instruktur ON jenisolahraga.kodeinstruktur = instruktur.kodeinstruktur WHERE kodeolahraga = '$kodeolahraga'") or die(mysql_error());
$data = mysql_fetch_array($sql);

$html = '<html><body style ="backgournd-image:(../../../gambar/desainweb/Sports.png);">'.
		'<center><h1>Laporan Data Aktivitas Olahraga </h1></center>'.
		'<table>
			<tr>
				<th>Kode kodeolahraga '.$data['kodeolahraga'].'</th>
			</tr>
			<tr>
				<td>Aktivitas Olahraga</td>
				<td>:</td>
				<td>'.$data['namaolahraga'].'</td>
			</tr>
			<tr>
				<td>Hargar</td>
				<td>:</td>
				<td>'.$data['harga'].'</td>
			</tr>
			<tr>
				<td>Waktu</td>
				<td>:</td>
				<td>'.$data['waktu'].' - '.$data['waktu2'].'</td>
			</tr>
			<tr>
				<td>Kode Instruktur</td>
				<td>:</td>
				<td>'.$data['kodeinstruktur'].'</td>
			</tr>
			<tr>
				<td>Nama Instruktur</td>
				<td>:</td>
				<td>'.$data['namalengkap'].'</td>
			</tr>
			<tr>
				<td>Fasilitas</td>
				<td>:</td>
				<td>'.$data['fasilitas'].'</td>
			</tr>
			<tr>
				<td>Foto</td>
				<td>:</td>
				<td><img style="width:120px; height:120px;" src="../../../gambar/desainweb/'.$data['gambar'].'"></td>
			</tr>
		</table>
		</body></html>';
$dompdf = new dompdf();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream('Laporan_Data'.$data['kodeolahraga'].'.pdf',array('Attachment'=>0));

 ?>