<?php

session_start();

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

require 'functions.php';

$query = "SELECT * FROM t_pembeli";

// eksekusi query
$res = query($query);

if (isset($_POST['bt-cari'])) {
    $res = cari_pembeli($_POST['keyword']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pembeli</title>
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
        <h1>Data Pembeli</h1>
        <hr>
        </p>
        <p>
        <form action="" method="POST">
            <input type="text" name="keyword" id="keyword" autofocus placeholder="Cari" autocomplete="off">
            <button class="btn btn-secondary me-md-2 btn-sm" type="submit" name="bt-cari" id="bt-cari">Cari!</button>
        </form>
        </p>
        <div class="container-xl">
	
	<table class="table table-hover">
            <tr>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <th>Id Pembeli</th>
                <th>Nama Pembeli</th>
                <th>Alamat Pembeli</th>
                <th>No. HP</th>
                <th>Aksi</th>
            </tr>

            <?php foreach ($res as $row) : ?>
                <tr>
                    <td><?= $row['id_pembeli']; ?></td>
                    <td><?= $row['nama_pembeli']; ?></td>
                    <td><?= $row['alamat_pembeli']; ?></td>
                    <td><?= $row['no_hp']; ?></td>
                    <td>
                        <a class="btn btn-secondary btn-sm" href="ubah-pembeli.php?id_pembeli=<?= $row['id_pembeli']; ?>">Edit</button></a> | <a class="btn btn-danger btn-sm" href="hapus-pembeli.php?id_pembeli=<?= $row['id_pembeli']; ?>">Hapus</button></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>

      </center>
</body>
</html>