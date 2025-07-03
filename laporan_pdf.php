<?php
require('fpdf/fpdf.php');
require 'koneksi.php';

$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'Laporan Data Produk Foodcourt',0,1,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->SetFillColor(255,112,67);
$pdf->SetTextColor(255);
$pdf->Cell(10,10,'No',1,0,'C',true);
$pdf->Cell(60,10,'Nama Produk',1,0,'C',true);
$pdf->Cell(40,10,'Harga',1,0,'C',true);
$pdf->Cell(150,10,'Deskripsi',1,1,'C',true);
$pdf->SetFont('Arial','',11);
$pdf->SetTextColor(0);

$produk = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
$no = 1;
while($row = mysqli_fetch_assoc($produk)) {
    $pdf->Cell(10,10,$no++,1,0,'C');
    $pdf->Cell(60,10,$row['nama_produk'],1,0);
    $pdf->Cell(40,10,'Rp '.number_format($row['harga'],0,',','.'),1,0);
    $pdf->Cell(150,10,substr($row['deskripsi'],0,90),1,1);
}
$pdf->Output('I','laporan_produk.pdf');
?>
