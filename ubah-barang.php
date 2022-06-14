<?php

session_start();

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

require 'functions.php';

$kode_barang = $_GET['kode_barang'];
$query = "SELECT * FROM t_barang WHERE kode_barang='$kode_barang'";
$res = query($query)[0];

if (isset($_POST['simpan'])) {
    $res = ubah_barang($_POST);

    if ($res > 0) {
        echo "
            <script>
                alert('Data berhasil diubah!');
                document.location.href = 'barang.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data gagal diubah!');
                document.location.href = 'barang.php';
            </script>
        ";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Barang</title>
</head>
<body>
<?php navigator(); ?>
    <h1>Ubah Data Barang</h1>

    <center>
    <form action="" method="POST">
    <label for="kode_barang">Kode Barang : </label><br>
        <input type="text" name="kode_barang" id="kode_barang" value="<?= $res['kode_barang']; ?>" readonly><br>

        <label for="nama_barang">Nama Barang : </label><br>
        <input type="text" name="nama_barang" id="nama_barang" value="<?= $res['nama_barang']; ?>"><br>

        <label for="modal">Modal : </label><br>
        <input type="text" name="modal" id="modal" value="<?= $res['modal']; ?>"><br>

        <label for="harga_jual">Harga Jual : </label><br>
        <input type="text" name="harga_jual" id="harga_jual" value="<?= $res['harga_jual']; ?>"><br>

        <label for="stok">Stok : </label><br>
        <input type="text" name="stok" id="stok" value="<?= $res['stok']; ?>"><br>
        <br>
        <button  class="btn btn-secondary me-md-2 btn-sm" type="submit" name="simpan">Simpan</button>
    </form>
    </center>
</body>
</html>