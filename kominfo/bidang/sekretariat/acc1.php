<?php
$id_magang=$_POST['id_magang'];
include "../../koneksi.php";
$bidang=$_POST['bidang'];
$tgl_mulai=$_POST['tgl_mulai'];
$tgl_selesai=$_POST['tgl_selesai'];
date_default_timezone_set("asia/jakarta");
$tgl_acc=date("Y-m-d");
$sql="UPDATE `magang` SET `status`=2, `bidang`='$bidang', `tgl_acc`='$tgl_acc', `tgl_mulai`='$tgl_mulai', `tgl_selesai`='$tgl_selesai' WHERE id_magang='$id_magang'";
$query=mysqli_query($conn, $sql);
$cari_max1=mysqli_query($conn, "SELECT MAX(id_dokumen) AS max FROM dokumen");
$cari1=mysqli_fetch_array($cari_max1);
$kode1=substr($cari1['max'],1,4);
$tambah1=$kode1+1;
if ($tambah1<10) {
	$id1="D000".$tambah1;
}else{
	$id1="D00".$tambah1;
}
$file=$_FILES['surat_balasan'];
$nama_file=explode(".", $file['name']);
$file_name="Surat Balasan-".$id_magang.".".$nama_file[1];
$file_temp=$file['tmp_name'];
$name=explode('.',$file_name);
$path="../../dokumen/surat_balasan/".$file_name;
$conn->query("INSERT INTO `dokumen`(`id_dokumen`, `id_magang`, `name`, `file`) VALUES ('$id1', '$id_magang', '$name[0]','$path')");
move_uploaded_file($file_temp, $path);
echo "<script> 
		alert('Berhasil acc!');
		document.location.href = 'pengajuan.php';
	  </script>";
?>
