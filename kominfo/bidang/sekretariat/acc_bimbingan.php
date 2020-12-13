<?php
$id_bimbingan=$_GET['id_bimbingan'];
include "../../koneksi.php";
$sql="UPDATE `bimbingan` SET `status`=2 WHERE id_bimbingan='$id_bimbingan'";
if (mysqli_query($conn,$sql)) {
	echo "<script>
            alert('Berhasil acc bimbingan!');
            document.location.href = 'bimbingan.php';
          </script>";
}
?>