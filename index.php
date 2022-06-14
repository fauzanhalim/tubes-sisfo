<?php

require 'functions.php';

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <style>
         body {
            /* background-color: skyblue; */
            padding-top: 4rem ;
        }

        .horizontal_center {
            /*mengatur border bagian atas tag div */
            border-top: 6px solid black;
            /* mengatur tinggi tag div*/
            height: 2px;
            /*mengatur lebar tag div*/
            width: 600px;
        }
    </style>
    <center>
    
        <!-- <h1>Menu Admin</h1> -->
        <h1>Selamat Datang Di App DarkHorse</h1>
        <div class="horizontal_center"></div>
        <!-- <h2>Selamat Datang Di App DarkHorse</h2> -->
        <br>
        <p>
        <h2>Silakan pilih aktifitas yang ingin dilakukan dengan mengklik menu yang tersedia.</h2>
        </p>
        <?php navigator(); ?>
    </center>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 
</body>

</html>