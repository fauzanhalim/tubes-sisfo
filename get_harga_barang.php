<?php

require 'functions.php';

$conn = db_conn();

if (isset($_GET['kode_barang'])) {

    $kode_barang = $_GET['kode_barang'];
    $query = "SELECT * FROM t_barang WHERE kode_barang='$kode_barang'";
}

$res = $conn->query($query);
$rows = $res->fetch_all(MYSQLI_ASSOC);

echo json_encode($rows);

?>