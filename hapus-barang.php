<?php

session_start();

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

require 'functions.php';

$res = hapus_barang($_GET['kode_barang']);

if ($res > 0) {
    echo "
        <script>
            alert('Data berhasil dihapus!');
            document.location.href = 'barang.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Data gagal dihapus!');
            document.location.href = 'barang.php';
        </script>
    ";
}

?>