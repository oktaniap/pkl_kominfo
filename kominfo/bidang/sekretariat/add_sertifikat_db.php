<?php
include "../../koneksi.php";
$id_magang=$_POST['id_magang'];
$id_pemagang=$_POST['id_pemagang'];
$total=count($id_pemagang);
for ($i=0; $i < $total; $i++) { 
	$sql2="SELECT nama FROM pemagang WHERE id_pemagang='$id_pemagang[$i]'";
	$query2=mysqli_query($conn, $sql2);
	while ($row2=mysqli_fetch_array($query2)) {
		$namadb=$row2['nama'];
	}
	$nama_file=explode(".", $_FILES['sertif']['name'][$i]);
	$file_name = "Sertifikat-".$id_magang."-".$namadb.".".$nama_file[1];
	$file_temp =$_FILES['sertif']['tmp_name'][$i];
	$name=explode('.', $file_name);
	$path="../../dokumen/sertifikat/".$file_name;
	$status=2;
	$conn->query("UPDATE `pemagang` SET `status_sertif`='$status', `sertif`='$name[0]', `file_sertif`='$path' WHERE id_pemagang='$id_pemagang[$i]'");
	move_uploaded_file($file_temp, $path);
}
$sql1="UPDATE `magang` SET `status`= 5 WHERE id_magang='$id_magang'";
if (mysqli_query($conn, $sql1)) {
	echo "<script> 
		    alert('Berhasil!');
		    document.location.href = 'sertifikat.php';
		  </script>";
}else{
	echo "<script> 
		    alert('Gagal!');
		    document.location.href = 'sertifikat.php';
		  </script>";
}
?>