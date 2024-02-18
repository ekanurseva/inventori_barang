<?php
require_once '../vendor/autoload.php'; // Mengimpor DomPDF

use Dompdf\Dompdf;

// Membuat objek Dompdf
$dompdf = new Dompdf();

// Konten HTML yang akan diubah menjadi PDF
$html = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>LAPORAN BARANG KELUAR</title>

            <style>
                        table {
                            border-collapse: collapse;
                            width: 100%;
                        }

                        th, td {
                            border: 1px solid black;
                            padding: 8px;
                            text-align: center;
                            vertical-align: middle;
                            font-size: 15px;
                        }

                        th {
                            background-color: #f2f2f2;
                        }

                        p {
                            text-align: justify; 
                            text-indent: 0.3in;
                            font-size: 14px;
                        }
                        li {
                            text-align: justify;
                            padding: 0;
                            padding: 0;
                            margin: 0;
                            left: 0;
                            font-size: 14px;
                        }
                    </style>
        </head>
        <body>
            <h2 style="text-align: center">LAPORAN BARANG KELUAR</h2><br>

            <table>
            <tr>
                <th>NO</th>
                <th>KODE TRANSAKSI</th>
                <th>TANGGAL TRANSAKSI</th>
                <th>PELANGGAN</th>
                <th>BARANG</th>
                <th>JUMLAH</th>
                <th>TOTAL JUMLAH</th>
            </tr>';

$html .= '<tr>
                            <td>1</td>
                            <td>TP-20240201</td>
                            <td>12-12-2023 10:12:05</td>
                            <td>Eka</td>
                            <td>Cincau</td>
                            <td>2</td>
                            <td>Rp 100.000</td>
                        </tr>';
$html .= '<tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <th>TOTAL KESELURUHAN</th>
                <th>Rp 100.000</th>
            </tr>
</table>

        </body>
        </html>';

// Memasukkan konten HTML ke Dompdf
$dompdf->loadHtml($html);

// Merender PDF (mengubah HTML menjadi PDF)
$dompdf->render();

// Ambil output PDF
$output = $dompdf->output();

// Konversi output PDF menjadi data URI
$pdfDataUri = 'data:application/pdf;base64,' . base64_encode($output);

// Tampilkan pratinjau PDF di browser
echo '<embed src="' . $pdfDataUri . '" type="application/pdf" width="100%" height="100%">';
?>