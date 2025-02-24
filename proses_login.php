<?php
include 'koneksi.php';

$user = $_POST['username'];
$pass = $_POST['password'];
$sql = mysqli_query($koneksi, "SELECT * FROM login WHERE username='$user' && password='$pass'");
$cek = mysqli_num_rows($sql);
if($cek > 0){
	$data = mysqli_fetch_assoc($sql);
	if($data['level']=="admin"){
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "admin";
		header("location:index.php"); 
	}else if($data['level']=="user"){

		$_SESSION['username'] = $username;
		$_SESSION['level'] = "user";

		header("location:user.php");
	}else{

		header("location: login.php?pesan=gagal");
	}	
}else{
	header("location: login.php?pesan=gagal");
}
?> 