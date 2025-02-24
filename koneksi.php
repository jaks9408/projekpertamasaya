<?php
$server = "localhost";
$user = "root";
$password= "";
$database = "dbcrud2022";
// buat koneksi
$koneksi = mysqli_connect ($server, $user, $password, $database);


if ($koneksi->connect_error) {
	die('Database Tidak Terhubung, Error : ' .$conn->connect_error);
}
?>