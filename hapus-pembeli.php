<?php

session_start();

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

require 'functions.php';

$res = hapus_pembeli($_GET['id_pembeli']);

if ($res > 0) {
    echo "
        <script>
            alert('Data berhasil dihapus!');
            document.location.href = 'pembeli.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Data gagal dihapus!');
            document.location.href = 'pembeli.php';
        </script>
    ";
}
