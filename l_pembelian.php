<?php

session_start();

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

require 'functions.php';

$query = "SELECT p.id_pembelian, p.tgl_beli, b.kode_barang, b.nama_barang, p.qty, b.modal * p.qty AS modal, p.total_harga, p.total_harga - b.modal * p.qty AS profit
FROM t_pembelian AS p, t_barang AS b
WHERE p.kode_barang=b.kode_barang";
//  AND MONTH(tgl_beli)=MONTH(current_date()) AND YEAR(tgl_beli)=YEAR(current_date())
$res = query($query);

$q_modal = "SELECT SUM(b.modal*p.qty) as 'Total Modal'
from t_pembelian as p, t_barang as b
where p.kode_barang=b.kode_barang";
$res_modal = query($q_modal)[0]['Total Modal'];

$q_jual = "select sum(p.total_harga) as 'Total Penjualan'
from t_pembelian as p, t_barang as b
where p.kode_barang=b.kode_barang";
$res_jual = query($q_jual)[0]['Total Penjualan'];

$q_prof = "select sum(p.total_harga - b.modal*p.qty) as 'Total Profit'
from t_pembelian as p, t_barang as b
where p.kode_barang=b.kode_barang";
$res_prof = query($q_prof)[0]['Total Profit'];

// if (isset($_POST['pdf'])) {
//     header('Location: cetak_pembelian.php');
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pembelian</title>
</head>

<body>
    <center>
        <style>
             body {
            background-color: skyblue;
            padding-top: 3rem ;
        }

        .horizontal_center {
            /*mengatur border bagian atas tag div */
            border-top: 4px solid black;
            /* mengatur tinggi tag div*/
            height: 2px;
            /*mengatur lebar tag div*/
            width: 2000px;
        }

        .horizontal {
            /*mengatur border bagian atas tag div */
            border-top: 4px solid black;
            /* mengatur tinggi tag div*/
            height: 2px;
            /*mengatur lebar tag div*/
            width: 600px;
        }
        </style>
        <p>
            <?php navigator(); ?>
        </p>
        <p>
        <h1>Laporan Pembelian DarkHorse</h1>
        </p>
        <hr>
        <!-- </center> -->
        <p>
        <form action="" method="post">

            <a href="cetak_pembelian.php" target="_blank">Print Document</a>
        </form>
        </p>
        <!-- <center> -->
        <div class="container-xl">
	
	<table class="table table-hover">
            <tr>
                <th>Id Pembelian</th>
                <th>Tanggal</th>
                <th>Barang</th>
                <th>Qty</th>
                <th>Modal</th>
                <th>Total Bayar</th>
                <th>Profit</th>
            </tr>

            <?php foreach ($res as $row) : ?>
                <tr>
                    <td><?= $row['id_pembelian']; ?></td>
                    <td><?= $row['tgl_beli']; ?></td>
                    <td><?= $row['kode_barang'] . " - " . $row['nama_barang']; ?></td>
                    <td><?= $row['qty']; ?></td>
                    <td><?= "Rp" . number_format($row['modal'], 0, ",", "."); ?></td>
                    <td><?= "Rp" . number_format($row['total_harga'], 0, ",", "."); ?></td>
                    <td><?= "Rp" . number_format($row['profit'], 0, ",", "."); ?></td>
                </tr>
            <?php endforeach; ?>
            <!-- total modal -->
            <tr>
                <td>Total Modal</td>
                <td colspan="6" align="right"><?= "Rp" . number_format($res_modal, 0, ",", "."); ?></td>
            </tr>
            <!-- total penjualan -->
            <tr>
                <td>Total Penjualan</td>
                <td colspan="6" align="right"><?= "Rp" . number_format($res_jual, 0, ",", "."); ?></td>
            </tr>
            <!-- total profit -->
            <tr>
                <td>Total Profit</td>
                <td colspan="6" align="right"><?= "Rp" . number_format($res_prof, 0, ",", ".");; ?></td>
            </tr>
        </table>
</body>
</html>