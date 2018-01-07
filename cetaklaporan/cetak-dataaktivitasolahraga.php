<?php
	include "../fungsi/koneksi/koneksi.php";
	$Lapor = "SELECT kodeolahraga, namaolahraga, harga, waktu, waktu2, fasilitas FROM jenisolahraga ORDER by kodeolahraga";
	$Hasil = mysql_query($Lapor);
	$Data = array();
	while($row = mysql_fetch_assoc($Hasil)){
		array_push($Data, $row);
	}
	$Judul = "Laporan Data Aktivitas Olahraga";
	$tgl= "Time : ".date("l, d F Y");
	$Header= array(
		array("label"=>"Kode Olahraga", "length"=>40, "align"=>"L"),
		array("label"=>"Aktivitas Olahraga", "length"=>50, "align"=>"L"),
		array("label"=>"Harga", "length"=>50, "align"=>"L"),
		array("label"=>"Waktu Mulai", "length"=>50, "align"=>"L"),
		array("label"=>"Waktu Selesai", "length"=>50, "align"=>"L"),
		array("label"=>"Fasilitas", "length"=>50, "align"=>"L"),
	);
	require ("../laporan/fpdf.php");
	$pdf = new FPDF();
	$pdf->AddPage('L','A4','C');
	//judul
	$pdf->SetFont('arial','B','15');
	$pdf->Cell(0, 15, $Judul, '0', 1, 'C');
	//tanggal
	$pdf->SetFont('arial','i','9');
	$pdf->Cell(0, 10, $tgl, '0', 1, 'P');
	//header
	$pdf->SetFont('arial','','12');
	$pdf->SetFillColor(190,190,0);
	$pdf->SetTextColor(255);
	$pdf->setDrawColor(128,0,0);
	foreach ($Header as $Kolom){
		$pdf->Cell($Kolom['length'], 8, $Kolom['label'], 1, '0', $Kolom['align'], true);
	}
	$pdf->Ln();
	//menampilkan data
	$pdf->SetFillColor(244,235,255);
	$pdf->SettextColor(0);
	$pdf->SetFont('arial','','10');
	$fill =false;
	foreach ($Data as $Baris){
		$i= 0;
		foreach ($Baris as $Cell){
			$pdf->Cell ($Header[$i]['length'], 7, $Cell, 2, '0', $Kolom['align'], $fill);
			$i++;
		}
		$fill = !$fill;
		$pdf->Ln();
	}
	//output
	$pdf->Output();
?>