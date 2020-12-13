<?php
include "../koneksi.php";
$id_magang=$_POST['id_magang'];
$id_pemagang=$_POST['id_pemagang'];
$nilai=$_POST['nilai'];
$nilai=(int)$nilai;
$total=count($id_pemagang);
for ($i=0; $i < $total; $i++) { 
	$sql="UPDATE `pemagang` SET `nilai`='$nilai[$i]' WHERE id_pemagang='$id_pemagang[$i]'";
	$query=mysqli_query($conn,$sql);
}
$sql1="UPDATE `magang` SET `status`= 4 WHERE id_magang='$id_magang'";
if (mysqli_query($conn, $sql1)) {
	echo "<script> 
		    alert('Berhasil!');
		    document.location.href = 'penilaian.php';
		  </script>";
}else{
	echo "<script> 
		    alert('Gagal!');
		    document.location.href = 'penilaian.php';
		  </script>";
}
?>