<?php 
require_once('../../../dompdf/dompdf_config.inc.php');
include '../../../fungsi/koneksi/koneksi.php';
$kodekonfirmasi = $_GET['kodekonfirmasi'];
$sql = mysql_query("SELECT * FROM konfirmasi JOIN (transaksi JOIN jenisolahraga JOIN member) ON konfirmasi.kodebooking = transaksi.kodebooking AND konfirmasi.kodemember = member.kodemember AND transaksi.kodeolahraga = jenisolahraga.kodeolahraga WHERE kodekonfirmasi = '$kodekonfirmasi'") or die(mysql_error());
$data = mysql_fetch_array($sql);

$html = '<html><body style ="backgournd-image:(../../../gambar/desainweb/Sports.png);">'.
		'<center><h1>Laporan Data Konfirmasi </h1></center>'.
		'<table>
			<tr>
				<th>Kode Konfirmasi '.$data['kodekonfirmasi'].'</th>
			</tr>
			<tr>
				<td>Kode Pesan</td>
				<td>:</td>
				<td>'.$data['kodebooking'].'</td>
			</tr>
			<tr>
				<td>Nama Anggota</td>
				<td>:</td>
				<td>'.$data['namalengkap'].'</td>
			</tr>
			<tr>
				<td>Aktivitas Olahraga</td>
				<td>:</td>
				<td>'.$data['namaolahraga'].'</td>
			</tr>
			<tr>
				<td>Tanggal Aktivitas</td>
				<td>:</td>
				<td>'.$data['tanggal'].'</td>
			</tr>
			<tr>
				<td>Bukti Bayar</td>
				<td>:</td>
				<td><img style="width:120px; height:120px;" src="../../../gambar/foto/'.$data['buktibayar'].'"></td>
			</tr>
			<tr>
				<td>Bank Sumber</td>
				<td>:</td>
				<td>'.$data['banksumber'].'</td>
			</tr>
			<tr>
				<td>Nomor Rekening</td>
				<td>:</td>
				<td>'.$data['norek'].'</td>
			</tr>
		</table>
		</body></html>';
$dompdf = new dompdf();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream('Laporan_Data'.$data['kodebooking'].'.pdf',array('Attachment'=>0));

 ?>