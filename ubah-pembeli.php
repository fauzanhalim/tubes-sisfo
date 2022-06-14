<?php

session_start();

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

require 'functions.php';

$id_pembeli = $_GET['id_pembeli'];
$query = "SELECT * FROM t_pembeli WHERE id_pembeli='$id_pembeli'";
$res = query($query)[0];

if (isset($_POST['simpan'])) {
    $res = ubah_pembeli($_POST);

    if ($res > 0) {
        echo "
            <script>
                alert('Data berhasil diubah!');
                document.location.href = 'pembeli.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data gagal diubah!');
                document.location.href = 'pembeli.php';
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
    <title>Ubah Data Pembeli</title>
</head>

<body>
<?php navigator(); ?>
    <h1>Ubah Data Pembeli</h1>

    <center>
    <form action="" method="POST">
        <label for="id_pembeli">Id Pembeli : </label><br>
        <input type="text" name="id_pembeli" id="id_pembeli" value="<?= $res['id_pembeli']; ?>" readonly><br>

        <label for="nama_pembeli">Nama Pembeli : </label><br>
        <input type="text" name="nama_pembeli" id="nama_pembeli" value="<?= $res['nama_pembeli']; ?>"><br>

        <label for="alamat_pembeli">Alamat Pembeli : </label><br>
        <input type="text" name="alamat_pembeli" id="alamat_pembeli" value="<?= $res['alamat_pembeli']; ?>"><br>

        <label for="no_hp">No Hp : </label><br>
        <input type="text" name="no_hp" id="no_hp" value="<?= $res['no_hp']; ?>"><br>
        <br>
        <button  class="btn btn-secondary me-md-2 btn-sm"type="submit" name="simpan">Simpan</button>
    </form>
    </center>
</body>

</html>