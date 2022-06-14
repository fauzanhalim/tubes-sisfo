<?php

session_start();

if ( !isset($_SESSION['login']) ) {
    header('Location: login.php');
    exit;
}

require 'functions.php';

$query = "SELECT t_pembayaran.id_pembayaran, t_pembelian.id_pembelian, t_pembayaran.tgl_bayar, t_pembelian.total_harga 
from t_pembayaran,t_pembelian 
where t_pembayaran.id_pembayaran=id_pembayaran;";
$res = query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pembayaran</title>
</head>
<body>
    <?php navigator(); ?>
    <h1>Data Pembayaran</h1>

    <form action="" method="post">
        <input type="text" name="keyword" id="keyword">
        <button type="submit" name="btn-cari" id="btn-cari">Cari!</button>
    </form>
 
              <br>
              <div class="container-xl">
	
	<table class="table table-hover">
        <tr>
            <th>Id Pembayaran</th>
            <th>Id Pembelian</th>
            <th>tanggal Bayar</th>
            <th>Total Pembayaran</th>
        </tr>
        
            <?php foreach($res as $row) : ?>
            <tr>
                <td><?= $row['id_pembayaran']; ?></td>
                <td><?= $row['id_pembelian']; ?></td>
                <td><?= $row['tgl_bayar']; ?></td>
                <td><?= $row['total_harga']; ?></td>
                </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>