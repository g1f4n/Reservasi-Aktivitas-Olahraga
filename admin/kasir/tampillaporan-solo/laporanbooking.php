<?php 
require_once('../../../dompdf/dompdf_config.inc.php');
include '../../../fungsi/koneksi/koneksi.php';
$kodebooking = $_GET['kodebooking'];
$sql = mysql_query("SELECT * FROM transaksi JOIN (member JOIN jenisolahraga JOIN instruktur) ON transaksi.kodemember = member.kodemember AND transaksi.kodeolahraga = jenisolahraga.kodeolahraga AND jenisolahraga.kodeinstruktur = instruktur.kodeinstruktur WHERE kodebooking = '$kodebooking'") or die(mysql_error());
$data = mysql_fetch_array($sql);
$namalengkap = $data['kodemember'];
$namaolahraga = $data['namaolahraga'];
$instruktur = $data['namalengkap'];
$tanggal = $data['tanggal'];
$waktu = $data['waktu'];
$waktu2 = $data['waktu2'];

$html = '<html><body style ="backgournd-image:(../../../gambar/desainweb/Sports.png);">'.
		'<center><h1>Laporan Data Pemesanan </h1></center>'.
		'<table>
			<tr>
				<th>Kode Pesan '.$data['kodebooking'].'</th>
			</tr>
			<tr>
				<td>Kode Anggota</td>
				<td>:</td>
				<td>'.$data['kodemember'].'</td>
			</tr>
			<tr>
				<td>Aktivitas Olahraga</td>
				<td>:</td>
				<td>'.$data['namaolahraga'].'</td>
			</tr>
			<tr>
				<td>Aktivitas Olahraga</td>
				<td>:</td>
				<td>'.$data['namalengkap'].'</td>
			</tr>
			<tr>
				<td>Tanggal Aktivitas</td>
				<td>:</td>
				<td>'.$data['tanggal'].'</td>
			</tr>
			<tr>
				<td>Waktu Mulai</td>
				<td>:</td>
				<td>'.$data['waktu'].'</td>
			</tr>
			<tr>
				<td>Waktu Selesai</td>
				<td>:</td>
				<td>'.$data['waktu2'].'</td>
			</tr>
			<tr>
				<td>Jumlah</td>
				<td>:</td>
				<td>'.$data['jumlah'].' Orang</td>
			</tr>
		</table>
		</body></html>';
$dompdf = new dompdf();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream('Laporan_Data'.$data['kodebooking'].'.pdf',array('Attachment'=>0));

 ?>