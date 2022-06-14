<?php

session_start();

if ( !isset($_SESSION['login']) ) {
    header('Location: login.php');
    exit;
}

require 'functions.php';

// echo $_SESSION['username'];

$query = "SELECT * FROM t_barang WHERE stok > 0";
$barangs = query($query);

$query = "SELECT id_pembeli FROM t_pembeli ORDER BY id_pembeli DESC";
$pembeli = query($query)[0];

// $query = "SELECT CURDATE() as today";
// $date = query($query);

// var_dump($date);

if (isset($_POST['simpan'])) {
    $res1 = tambah_pembeli($_POST);
    $res2 = tambah_pembelian($_POST, $_SESSION);
    
    if ($res1 > 0 && $res2 > 0) {
        echo "
        <script>
            alert('Pembelian berhasil!');
            document.location.href = 'pembelian.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Pembelian gagal');
            document.location.href = 'pembelian.php';
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
    <title>Tambah Pembelian</title>
    <script src="js/script.js"></script>
</head>
<body>
    <?php navigator(); ?>
    <h1>Tambah Pembelian</h1>
    
    <center>
    <form action="" method="post">
        <h2>Data Pembeli</h2>
    
        <label for="id_pembeli">Id Pembeli : </label><br>
        <input type="text" name="id_pembeli" id="id_pembeli" readonly value="<?= (int)$pembeli['id_pembeli'] + 1; ?>"><br>

        <label for="nama_pembeli">Nama Pembeli : </label><br>
        <input type="text" name="nama_pembeli" id="nama_pembeli"><br>

        <label for="alamat_pembeli">Alamat Pembeli</label><br>
        <input type="text" name="alamat_pembeli" id="alamat_pembeli"><br>

        <label for="no_hp">No Hp : </label><br>
        <input type="text" name="no_hp" id="no_hp"><br>

        <h2>Data Pembelian</h2>
        <label for="barang">Barang : </label><br>
        <select name="barang" id="barang" onchange="updateHarga()">
            <option value="">Pilih Barang</option>
            <?php foreach($barangs as $barang) : ?>
                <option value="<?= $barang['kode_barang']; ?>"><?= $barang['nama_barang']; ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="harga_barang">Harga Barang : </label><br>
        <input type="text" name="harga_barang" id="harga_barang" readonly><br>

        <label for="qty">Qty. : </label><br>
        <input type="text" name="qty" id="qty" onkeyup="updateTotalHarga()"><br>

        <label for="total_harga">Total Bayar : </label><br>
        <input type="text" name="total_harga" id="total_harga" readonly><br>
                <br>
        <button  class="btn btn-secondary me-md-2 btn-sm" type="submit" name="simpan">Konfirmasi Pembelian</button>
    </form>
    </center>
</body>
</html>