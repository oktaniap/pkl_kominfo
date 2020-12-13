<?php
session_start();
include "koneksi.php";
$username = $_POST['username'];
$password = $_POST['password'];
$sql = "SELECT * FROM pengguna WHERE username='$username' AND password='$password'";
$query=mysqli_query($conn,$sql);
$cek = mysqli_num_rows($query);
if($cek > 0){
	$row=mysqli_fetch_array($query);
	$akses=$row['akses'];
	$_SESSION['username']=$row['username'];
	$_SESSION['nama_depan']=$row['nama_depan'];
	$_SESSION['nama_belakang']=$row['nama_belakang'];
	if ($akses=="user") {
		echo "<script> 
            alert('Login Berhasil!');
            document.location.href = 'user/index.php';
        </script>";
	}if ($akses=="sekre") {
		echo "<script> 
            alert('Login Berhasil!');
            document.location.href = 'bidang/sekretariat/index.php';
        </script>";
	}else{
		echo "<script> 
            alert('Login Berhasil!');
            document.location.href = 'bidang/index.php';
        </script>";	
	}
}else{
	echo "<script> 
            alert('Login Gagal!');
            document.location.href = 'index.html';
        </script>";
}
?>