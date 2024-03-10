<?php
require_once '../vendor/autoload.php'; // Mengimpor DomPDF
require_once '../controller/MainController.php';

$dari = $_GET['dari'];
$sampai = $_GET['sampai'];

if($sampai != "") {
    $timestamp = strtotime($sampai);
    $sampai_1 = $timestamp + (1 * 24 * 60 * 60);

    $sampai_1hari = date("Y-m-d", $sampai_1);
}

if($dari != "" && $sampai != "") {
    $data_masuk = query("SELECT idtransaksi FROM barang_masuk WHERE tgl_masuk < '$sampai_1hari' AND tgl_masuk >= '$dari' AND tgl_masuk IS NOT null GROUP BY idtransaksi");
} elseif($dari == "" && $sampai == "") {
    $data_masuk = query("SELECT idtransaksi FROM barang_masuk WHERE tgl_masuk IS NOT null GROUP BY idtransaksi");
} elseif($sampai == "") {
    $data_masuk = query("SELECT idtransaksi FROM barang_masuk WHERE tgl_masuk >= '$dari' AND tgl_masuk IS NOT null GROUP BY idtransaksi");    
} elseif($dari == "") {
    $data_masuk = query("SELECT idtransaksi FROM barang_masuk WHERE tgl_masuk < '$sampai_1hari' AND tgl_masuk IS NOT null GROUP BY idtransaksi");
}

$i = 1;
$total = 0;

use Dompdf\Dompdf;

// Membuat objek Dompdf
$dompdf = new Dompdf();

// Konten HTML yang akan diubah menjadi PDF
$html = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>LAPORAN BARANG MASUK</title>

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
            <h2 style="text-align: center">LAPORAN BARANG MASUK</h2><br>

            <table>
            <tr>
                <th>NO</th>
                <th>NOMOR BUKTI</th>
                <th>TANGGAL MASUK BARANG</th>
                <th>PEMASOK</th>
                <th>PERMINTAAN BARANG</th>
                <th>JUMLAH</th>
                <th>TOTAL JUMLAH</th>
            </tr>';
foreach($data_masuk as $id) {
    $idtransaksi = $id['idtransaksi'];
    $transaksi = query("SELECT * FROM transaksi_pembelian WHERE idtransaksi = $idtransaksi")[0];

    $idpemasok = $transaksi['idpemasok'];
    $nama_pemasok = query("SELECT nama FROM user WHERE iduser = $idpemasok")[0];

    $bahan = query("SELECT * FROM barang_masuk WHERE idtransaksi = $idtransaksi");
    $tanggal = date("d-m-Y | H:i:s", strtotime($bahan[0]['tgl_masuk']));

    $total_satuan = 0;
    
    foreach($bahan as $item){
        $idbahan = $item['idbahan'];

        $item_bahan = query("SELECT harga FROM bahan_pemasok WHERE idbahan = $idbahan")[0];

        $total_satuan += $item['qty'] * $item_bahan['harga'];
    }

    $total += $total_satuan;

    $html .= '<tr>
                                <td>' . $i . '</td>
                                <td>' . $transaksi['kode_transaksi'] . '</td>
                                <td>' . $tanggal . '</td>
                                <td>' . $nama_pemasok['nama'] . '</td>
                                <td>
                                    <ul style="padding-left: 10px;">';
                                        foreach($bahan as $item){
                                            $idbahan = $item['idbahan'];

                                            $item_bahan = query("SELECT nama_bahan FROM bahan_pemasok WHERE idbahan = $idbahan")[0];
                                            $html .= '<li>' . $item_bahan['nama_bahan'] .  '</li>';
                                        }
                                    $html .= '</ul>
                                </td>
                                <td>
                                    <ul style="padding-left: 10px;">';
                                        foreach($bahan as $item){
                                            $idbahan = $item['idbahan'];

                                            $item_bahan = query("SELECT satuan FROM bahan_pemasok WHERE idbahan = $idbahan")[0];
                                            $html .= '<li>' . $item['qty'] . " " . $item_bahan['satuan'] .  '</li>';
                                        }
                                    $html .= '</ul>
                                </td>
                                <td>Rp ' . number_format($total_satuan, 0, ',' , '.') . '</td>
                            </tr>';
    $i++;
}
$html .= '<tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <th>TOTAL KESELURUHAN</th>
                <th>Rp ' . number_format($total, 0, ',' , '.') . '</th>
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