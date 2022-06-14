<?php

session_start();

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

require 'functions.php';

if (isset($_POST['simpan'])) {
    $res = tambah_barang($_POST);

    if ($res > 0) {
        echo "
        <script>
            alert('Data berhasil ditambahkan!');
            document.location.href = 'barang.php';
        </script>";
    } else {
        echo "
            <script>
                alert('Data gagal ditambahkan!');
                document.location.href = 'barang.php';
            </script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
</head>
<body>
    <?php navigator(); ?>
    <h1>Tambah Data</h1>

    <center>
    <form action="" method="POST">
        <label for="kode_barang">Kode Barang : </label><br>
        <input type="text" name="kode_barang" id="kode_barang" placeholder="ACCXXX" required><br>

        <label for="nama_barang">Nama Barang : </label><br>
        <input type="text" name="nama_barang" id="nama_barang"><br>

        <label for="modal">Modal : </label><br>
        <input type="text" name="modal" id="modal"><br>

        <label for="harga_jual">Harga Jual : </label><br>
        <input type="text" name="harga_jual" id="harga_jual"><br>

        <label for="stok">Stok : </label><br>
        <input type="text" name="stok" id="stok"><br>
        
        <button  class="btn btn-secondary me-md-2 btn-sm" type="submit" name="simpan">Simpan</button>
    </form>
    </center>
</body>
</html>