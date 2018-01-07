<?php 
require_once('../../dompdf/dompdf_config.inc.php');
include '../../fungsi/koneksi/koneksi.php';

$kodebooking   = @$_GET['kodebooking'];
$sql          = mysql_query("SELECT * FROM konfirmasi JOIN (transaksi JOIN member JOIN jenisolahraga JOIN instruktur) ON transaksi.kodemember = member.kodemember AND transaksi.kodeolahraga = jenisolahraga.kodeolahraga AND jenisolahraga.kodeinstruktur = instruktur.kodeinstruktur AND konfirmasi.kodebooking = transaksi.kodebooking WHERE konfirmasi.kodebooking = '$kodebooking'") or die(mysql_error());
$data         = mysql_fetch_array($sql);
$today = date('d-m-Y');
date_default_timezone_set('Asia/Jakarta');
$jam = date('h:i:s');


$kodebooking   = $data['kodebooking'];
$namalengkap  = $data['kodemember'];
$namaolahraga = $data['namaolahraga'];
$waktu         = $data['waktu'];
$waktu2         = $data['waktu2'];
$tanggal       = $data['tanggal'];
$fasilitas       = $data['fasilitas'];
$instruktur       = $data['namalengkap'];
$kodekonfirmasi = $data['kodekonfirmasi'];
$html = 
		'<html><body>'.
		'<center><h1>Bukti Pemesanan Anggota </h1></center>'.
		'<table width="80%" align="center">
			<tr>
				<th>Tanggal Cetak"'.$today.'" Pukul : '.$jam.'</th>
			</tr>'.
			'<tr>
				<td>Kode Konfirmasi Pembayaran</td>
				<td>'.$kodekonfirmasi.'</td>
			</tr>'.
			'<tr>
				<td>Kode Pemesanan</td>
				<td>'.$kodebooking.'</td>
			</tr>'.
			'<tr>
				<td>Kode Anggota</td>
				<td>'.$namalengkap.'</td>
			</tr>'.
			'<tr>
				<td>Aktivitas Olahraga</td>
				<td>'.$namaolahraga.'</td>
			</tr>'.
			'<tr>
				<td>Waktu Aktivitas</td>
				<td>'.$waktu.' - '.$waktu2.'</td>
			</tr>'.
			'<tr>
				<td>Tanggal Aktivitas</td>
				<td>'.$tanggal.'</td>
			</tr>'.
			'<tr>
				<td>Instruktur</td>
				<td>'.$instruktur.'</td>
			</tr>'.
			'<tr>
				<td>Fasilitas</td>
				<td>'.$fasilitas.'</td>
			</tr>'.
		'</table>
		</body></html>';

$dompdf = new dompdf();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream('Laporan_Data_Member_'.$namalengkap.'.pdf',array('Attachment'=>0));
 ?>