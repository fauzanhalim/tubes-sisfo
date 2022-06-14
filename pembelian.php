<?php

session_start();

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

require 'functions.php';

$query = "SELECT * FROM t_pembelian";
$res = query($query);

if (isset($_POST['btn-cari'])) {
    $res = cari_pembelian($_POST['keyword']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pembelian</title>
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

        <h1>Data Pembelian</h1>
        <hr>
        </p>
        <p>
            <a href="tambah-pembelian.php"><button class="btn btn-secondary me-md-2 btn-sm" >Tambah Pembelian</button> </a>
        </p>
        <p>
        <form action="" method="post">
            <input type="text" name="keyword" id="keyword" autofocus placeholder="Cari" autocomplete="off">
            <button class="btn btn-secondary me-md-2 btn-sm" type="submit" name="btn-cari" id="btn-cari">Cari!</button>
        </form>
        </p>

        <div class="container-xl">
	
	<table class="table table-hover">
            <tr>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <th>Id Pembelian</th>
                <th>Tanggal</th>
                <th>Id Pembeli</th>
                <th>Nama Pembeli</th>
                <th>Barang</th>
                <th>Harga</th>
                <th>Qty.</th>
                <th>Total Harga</th>
            </tr>

            <?php foreach ($res as $row) : ?>
                <tr>
                    <td><?= $row['id_pembelian']; ?></td>
                    <td><?= $row['tgl_beli']; ?></td>
                    <td><?= $row['id_pembeli']; ?></td>
                    <?php
                    $query = "SELECT nama_pembeli FROM t_pembeli WHERE id_pembeli='" . $row['id_pembeli'] . "'";
                    $pbeli = query($query)[0];
                    ?>
                    <td><?= $pbeli['nama_pembeli']; ?></td>
                    <?php
                    $query = "SELECT nama_barang, harga_jual FROM t_barang WHERE kode_barang='" . $row['kode_barang'] . "'";
                    $barang = query($query)[0];
                    ?>
                    <td><?= $row['kode_barang'] . " - " . $barang['nama_barang']; ?></td>
                    <td><?= "Rp" . number_format($barang['harga_jual'], 0, ",", "."); ?></td>
                    <td><?= $row['qty']; ?></td>
                    <td><?= "Rp" . number_format($row['total_harga'], 0, ",", "."); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
            </div>
    </center>
</body>
</html>