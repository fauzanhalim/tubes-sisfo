<?php

function db_conn()
{
    $conn = new mysqli('localhost', 'root', '', 'db_darkhorse');
    return $conn;
}

function show_error($message)
{ ?>
    <div style="background-color: #faebd7; padding: 10px; border: 1px solid red;margin: 15px 0px; width:fit-content">
        <?= $message; ?>
    </div>
<?php }

function query($query)
{

    $conn = db_conn();
    $res = $conn->query($query); // mysqli_query($conn, $query);
    $rows = [];

    // mysqli_fetch_assoc($res)
    while ($row = $res->fetch_assoc()) {

        $rows[] = $row;
    }

    return $rows;
}

// fungsi untuk db barang

function tambah_barang($data)
{

    $conn = db_conn();

    if ($conn->connect_errno == 0) {

        $kode_barang = htmlspecialchars($data["kode_barang"]);
        $nama_barang = htmlspecialchars($data["nama_barang"]);
        $modal = htmlspecialchars($data["modal"]);
        $harga_jual = htmlspecialchars($data["harga_jual"]);
        $stok = htmlspecialchars($data["stok"]);

        $query = "INSERT INTO t_barang
        VALUES
        ('$kode_barang', '$nama_barang', '$modal', '$harga_jual', '$stok')";

        // perform a query
        $conn->query($query);
        return $conn->affected_rows;
    } else {

        return "Gagal : " . $conn->error . "<br>";
    }
}

function ubah_barang($data)
{
    $conn = db_conn();

    if ($conn->connect_errno == 0) {

        $kode_barang = htmlspecialchars($data["kode_barang"]);
        $nama_barang = htmlspecialchars($data["nama_barang"]);
        $modal = htmlspecialchars($data["modal"]);
        $harga_jual = htmlspecialchars($data["harga_jual"]);
        $stok = htmlspecialchars($data["stok"]);

        $query = "UPDATE t_barang SET
        nama_barang='$nama_barang',
        modal='$modal',
        harga_jual='$harga_jual',
        stok='$stok'
        WHERE kode_barang='$kode_barang'";

        // eksekusi query
        $conn->query($query);
        return $conn->affected_rows;
    } else {
        return 'Gagal : ' . $conn->error . '<br>';
    }
}

function hapus_barang($data)
{
    $conn = db_conn();

    if ($conn->connect_errno == 0) {
        $query = "DELETE FROM t_barang WHERE kode_barang='$data'";
        $conn->query($query);
        return $conn->affected_rows;
    } else {
        return 'Gagal : ' . $conn->error . '<br>';
    }
}

// fungsi untuk db pembeli

function tambah_pembeli($data)
{

    $conn = db_conn();

    if ($conn->connect_errno == 0) {

        $id_pembeli = htmlspecialchars($data["id_pembeli"]);
        $nama_pembeli = htmlspecialchars($data["nama_pembeli"]);
        $alamat_pembeli = htmlspecialchars($data["alamat_pembeli"]);
        $no_hp = htmlspecialchars($data["no_hp"]);

        $query = "INSERT INTO t_pembeli 
        VALUES
        ('$id_pembeli', '$nama_pembeli', '$alamat_pembeli', '$no_hp')";

        // perform a query
        $conn->query($query);
        return $conn->affected_rows;
    } else {

        return "Gagal : " . $conn->error . "<br>";
    }
}

function ubah_pembeli($data)
{
    $conn = db_conn();

    if ($conn->connect_errno == 0) {

        $id_pembeli = htmlspecialchars($data["id_pembeli"]);
        $nama_pembeli = htmlspecialchars($data["nama_pembeli"]);
        $alamat_pembeli = htmlspecialchars($data["alamat_pembeli"]);
        $no_hp = htmlspecialchars($data["no_hp"]);

        $query = "UPDATE t_pembeli SET
        nama_pembeli='$nama_pembeli',
        alamat_pembeli='$alamat_pembeli',
        no_hp='$no_hp',
        WHERE id_pembeli='$id_pembeli'";

        // eksekusi query
        $conn->query($query);
        return $conn->affected_rows;
    } else {
        return 'Gagal : ' . $conn->error . '<br>';
    }
}

function hapus_pembeli($data)
{
    $conn = db_conn();

    if ($conn->connect_errno == 0) {
        $query = "DELETE FROM t_pembeli WHERE id_pembeli='$data'";
        $conn->query($query);
        return $conn->affected_rows;
    } else {
        return 'Gagal : ' . $conn->error . '<br>';
    }
}

function tambah_pembelian($data, $karyawan)
{
    $conn = db_conn();

    if ($conn->connect_errno == 0) {
        $id_pembeli = htmlspecialchars($data["id_pembeli"]);
        $id_karyawan = htmlspecialchars($karyawan['username']);
        $kode_barang = htmlspecialchars($data["barang"]);
        $qty = htmlspecialchars($data["qty"]);
        $total_harga = htmlspecialchars($data["total_harga"]);
        $tgl_beli = query("SELECT CURDATE() AS today")[0]['today'];

        $query = "INSERT INTO t_pembelian (id_pembeli, tgl_beli, kode_barang, qty, total_harga, id_karyawan) 
        VALUES
        ('$id_pembeli', '$tgl_beli', '$kode_barang', '$qty', '$total_harga', '$id_karyawan')";

        // perform a query
        $conn->query($query);
        return $conn->affected_rows;
    } else {
        return "Gagal : " . $conn->error . "<br>";
    }
}
// function ubah_pembeli($data) {
//     $conn = db_conn();

//     if ($conn->connect_errno == 0) {

//         $id_pembeli = htmlspecialchars($data["id_pembeli"]);
//         $nama_pembeli = htmlspecialchars($data["nama_pembeli"]);
//         $alamat_pembeli = htmlspecialchars($data["alamat_pembeli"]);
//         $no_hp = htmlspecialchars($data["no_hp"]);

//         $query = "UPDATE t_pembeli SET
//         nama_pembeli='$nama_pembeli',
//         alamat_pembeli='$alamat_pembeli',
//         no_hp='$no_hp' 
//         WHERE id_pembeli='$id_pembeli'";

//         // eksekusi query
//         $conn -> query($query);
//         return $conn->affected_rows;
//     } else {
//         return 'Gagal : '.$conn->error.'<br>';
//     }
// }

// function hapus_pembeli($data) {
//     $conn = db_conn();

//     if ($conn->connect_errno == 0) {
//         $query = "DELETE FROM t_barang WHERE kode_barang='$data'";
//         $conn->query($query);
//         return $conn->affected_rows;
//     } else {
//         return 'Gagal : '.$conn->error.'<br>';
//     }
// }

function cari_barang($keyword) {
    $query = "SELECT kode_barang, nama_barang, modal, harga_jual, stok
    FROM t_barang
    WHERE
    kode_barang LIKE '%$keyword%' OR nama_barang LIKE '%$keyword%' OR modal LIKE '%$keyword%' OR harga_jual LIKE '%$keyword%' OR stok LIKE '%$keyword%'";

    return query($query);

}

function cari_pembeli($keyword) {
    $query = "SELECT id_pembeli, nama_pembeli, alamat_pembeli, no_hp
    FROM t_pembeli
    WHERE
    id_pembeli LIKE '%$keyword%' OR nama_pembeli LIKE '%$keyword%' OR alamat_pembeli LIKE '%$keyword%' OR no_hp LIKE '%$keyword%'";

    return query($query);

}

function cari_pembelian($keyword) {
    $query = "SELECT pb.id_pembelian, pb.tgl_beli, p.id_pembeli, p.nama_pembeli, b.kode_barang, b.nama_barang, b.harga_jual, pb.qty, pb.total_harga
    FROM t_pembelian AS pb
    JOIN t_barang AS b ON b.kode_barang = pb.kode_barang
    JOIN t_pembeli AS p ON pb.id_pembeli = p.id_pembeli
    WHERE
    pb.id_pembelian LIKE '%$keyword%' OR pb.tgl_beli LIKE '%$keyword%' OR p.id_pembeli LIKE '%$keyword%' OR p.nama_pembeli LIKE '%$keyword%' OR b.kode_barang LIKE '%$keyword%' OR b.nama_barang LIKE '%$keyword%' OR b.harga_jual LIKE '%$keyword%' OR pb.qty LIKE '%$keyword%' OR pb.total_harga LIKE '%$keyword%'";

    return query($query);

}

function navigator()

{ ?>
	  <head>
	    <!-- Required meta tags -->
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	    <!-- Bootstrap CSS -->
	    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	    <title>DarkHorse</title>
	  </head>
	  <body>
	  <nav class="navbar navbar-expand-lg navbar navbar-dark shadow-sm fixed-top " style="background-color: darkgreen">
	    <div class="container">
		 <a class="navbar-brand" href="#">DarkHorse</a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
		   aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
		   <span class="navbar-toggler-icon"></span>
		 </button>
		 <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
		   <div class="navbar-nav ms-auto">
		    <a  class="nav-link" href="index.php">Home</a>
			<a  class="nav-link"href="barang.php">Barang</a>
			<a  class="nav-link" href="pembeli.php">Pembeli</a>
			<a  class="nav-link"href="pembelian.php">Pembelian</button></a>
			<a  class="nav-link"href="l_pembelian.php">Laporan Pembelian</button></a>
			<a  class="nav-link"href="logout.php">Logout</button></a>

		   </div>
		 </div>
	    </div>
	  </nav><?php
       }
      ?>
