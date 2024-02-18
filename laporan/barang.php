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
            <title>LAPORAN DAFTAR BARANG</title>

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
                            font-size: 14px;
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
            <h2 style="text-align: center">LAPORAN DAFTAR BARANG</h2><br>

            <table>
            <tr>
                <th>NO</th>
                <th>NAMA BARANG</th>
                <th>KATEGORI</th>
                <th>MERK</th>
                <th>GUDANG</th>
                <th>RAK</th>
                <th>STOK</th>
                <th>SATUAN</th>
                <th>HARGA</th>
                <th>KETERANGAN</th>
            </tr>';

$html .= '<tr>
                            <td>1</td>
                            <td>Es Cincau</td>
                            <td>Happy Es</td>
                            <td>Merk Barang</td>
                            <td>A</td>
                            <td>1</td>
                            <td>30</td>
                            <td>Dus</td>
                            <td>Rp 5.000</td>
                            <td>-</td>
                        </tr>';
'</table>

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