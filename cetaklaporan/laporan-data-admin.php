<?php
    include "../../fungsi/koneksi/koneksi.php";
    $kodeuser = @$_GET['kodeuser'];
    $Lapor = "SELECT kodeuser, nama, username FROM admin WHERE kodeuser = '$kodeuser'";
    $Hasil = mysql_query($Lapor);
    $Data = array();
    while($row = mysql_fetch_assoc($Hasil)){
        array_push($Data, $row);
    }
    $Judul = "Laporan Data Admin";
    $tgl= "Time : ".date("l, d F Y");
    $Header= array(
        array("label"=>"Kode User", "length"=>30, "align"=>"L"),
        array("label"=>"Nama Lengkap", "length"=>60, "align"=>"L"),
        array("label"=>"Username", "length"=>90, "align"=>"L"),
    );
    require ("../../laporan/fpdf.php");
    $pdf = new FPDF();
    $pdf->AddPage('P','A4','C');
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