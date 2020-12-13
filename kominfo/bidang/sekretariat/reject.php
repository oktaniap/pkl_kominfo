<?php
include "../../koneksi.php";
$id_magang=$_GET['id_magang'];
$sql="UPDATE `magang` SET `status`=3 WHERE id_magang='$id_magang'";
if (mysqli_query($conn,$sql)) {
	echo "<script> 
            alert('Magang berhasil diacc!');
            document.location.href = 'pengajuan.php';
        </script>";
}
?>