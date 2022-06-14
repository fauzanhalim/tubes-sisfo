<?php

session_start();

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

require 'functions.php';

$query = "SELECT * FROM t_barang";

// eksekusi query
$res = query($query);

if (isset($_POST['bt-cari'])) {
    $res = cari_barang($_POST['keyword']);
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
</head>

<body>
    <style>
        body {
            background-color: blue;
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
    <center>

        <p>
        <?php navigator(); ?>
        </p>
        <p>
        <h1>Data Barang</h1>
        <hr>
        </p>
        <p>
            <a href="tambah-barang.php"><button class="btn btn-secondary me-md-2 btn-sm" >Tambah Barang</button> </a>
        </p>
        <p>
        <form action="" method="POST">
            <input type="text" name="keyword" id="keyword" autofocus placeholder="Cari" autocomplete="off">
            <button  class="btn btn-secondary me-md-2 btn-sm" type="submit" name="bt-cari" id="bt-cari">Cari</button>
        </form>
        </p>
        <div class="container-xl">
	
	<table class="table table-hover">
                <tr>
               
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Modal</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>

                <?php foreach ($res as $row) : ?>
                    <tr>
                        <td><?= $row['kode_barang']; ?></td>
                        <td><?= $row['nama_barang']; ?></td>
                        <td><?= "Rp".number_format($row['modal'], 0, ",", "."); ?></td>
                        <td><?= "Rp".number_format($row['harga_jual'], 0, ",", "."); ?></td>
                        <td><?= $row['stok']; ?></td>
                        <td>
                            <a class="btn btn-secondary btn-sm" href="ubah-barang.php?kode_barang=<?= $row['kode_barang']; ?>">Edit</button></a> | <a class="btn btn-danger btn-sm"href="hapus-barang.php?kode_barang=<?= $row['kode_barang']; ?>">Hapus</button></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>

      </center>
</body>
</html>