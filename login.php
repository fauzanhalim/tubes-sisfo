<?php

session_start();

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

require 'functions.php';

if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $pass = $_POST["pass"];

    $conn = db_conn();
    $query = "SELECT * FROM t_karyawan WHERE id_karyawan='$username'";

    // eksekusi query
    $res = $conn->query($query);

    // cek username
    if ($res->num_rows === 1) {

        // cek password
        $row = $res->fetch_assoc();

        if ($pass == $row["pass"]) {
            // set session
            $_SESSION["login"] = true;
            $_SESSION["username"] = $username;

            header("Location: index.php");
            exit;
        }
    }

    $error = true;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DarkHorse</title>
</head>
<style>
    body {
        background-image: url("img/motor.jpg");
    }

    .wrapper {
        font-family: Arial;
        width: 400px;
        box-shadow: 1px 2px 4px rgba(0, 0, 0, .5);
        margin: 10% auto;
        padding: 40px;
        background: #08fd6e;
    }

    form input {
        width: 100%;
        height: 40px;
        border: 1px solid black;
        padding: 5px;
    }
</style>

<body>
    <div class="wrapper">
        <center>
            <h1>Login</h1>
        </center>
        <?php

        if (isset($error)) {
            show_error("Username/Password salah");
        }

        ?>

        <form action="" method="POST">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="Username" autofocus autocomplete="off">

            <br>
            <p>
                <label for="pass">Password</label>
                <input type="password" name="pass" id="pass" placeholder="Password">
            </p>
            <p>
                <center>
                    <button type="submit" name="login">Login</button>
                </center>
            </p>
        </form>
</body>

</html>