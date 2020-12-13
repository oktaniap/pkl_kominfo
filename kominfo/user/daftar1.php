<?php
include "../koneksi.php";
if (!isset($_FILES['proposal'])||!isset($_FILES['surat_rekom'])||!isset($_POST['institusi'])||!isset($_POST['jurusan'])||!isset($_POST['tujuan'])||!isset($_POST['nama'])||!isset($_FILES['kartu'])) {
	echo "<script> 
            alert('Ada data yang belum diisi!');
            document.location.href = 'daftar.php';
        </script>";
}else{
	session_start();
    $username=$_SESSION['username'];
    $query2 = "SELECT * FROM magang WHERE username='$username' AND status IN (1,2,4)";
    $sql = mysqli_query($conn, $query2);
    $cek = mysqli_num_rows($sql);
    if ($cek>=1) {
    	echo "<script> 
            alert('Anda masih memiliki proses magang');
            document.location.href = 'index.php';
        </script>";
    }else{
		$institusi=$_POST['institusi'];
		$tujuan=$_POST['tujuan'];
		$jurusan=$_POST['jurusan'];
		$cari_max=mysqli_query($conn, "SELECT MAX(id_magang) AS max FROM magang");
	    $cari=mysqli_fetch_array($cari_max);
	    $kode=substr($cari['max'],10,13);
	    $tambah=$kode+1;
	    $tgl=date("Ymd");
	    if ($tambah<10) {
	      $id="MK".$tgl."000".$tambah;
	    }else{
	      $id="MK".$tgl."00".$tambah;
	    }
	    $status=1;
	    date_default_timezone_set("asia/jakarta");
	    $tgl_daftar=date("Y-m-d");
		$query = "INSERT INTO `magang`(`id_magang`, `username`, `institusi`, `jurusan`, `tujuan`, `status`, `tgl_daftar`) VALUES ('$id', '$username', '$institusi', '$jurusan', '$tujuan', '$status', '$tgl_daftar')";
		if (mysqli_query($conn,$query)) {
	    	if ($_FILES['proposal']['name']!="") {
	    		$cari_max1=mysqli_query($conn, "SELECT MAX(id_dokumen) AS max FROM dokumen");
			    $cari1=mysqli_fetch_array($cari_max1);
			    $kode1=substr($cari1['max'],1,4);
			    $tambah1=$kode1+1;
			    if ($tambah1<10) {
			      $id1="D000".$tambah1;
			    }else{
			      $id1="D00".$tambah1;
			    }
	    		$file=$_FILES['proposal'];
	    		$nama_file=explode(".", $file['name']);
	    		$file_name="Proposal-".$id.".".$nama_file[1];
	    		$file_temp=$file['tmp_name'];
	    		$name=explode('.',$file_name);
	    		$path="../dokumen/".$file_name;
	    		$conn->query("INSERT INTO `dokumen`(`id_dokumen`, `id_magang`, `name`, `file`) VALUES ('$id1', '$id', '$name[0]','$path')");
	    		move_uploaded_file($file_temp, $path);
	    	}
	    	if ($_FILES['surat_rekom']['name']!="") {
	    		$cari_max2=mysqli_query($conn, "SELECT MAX(id_dokumen) AS max FROM dokumen");
			    $cari2=mysqli_fetch_array($cari_max2);
			    $kode2=substr($cari2['max'],1,4);
			    $tambah2=$kode2+1;
			    if ($tambah2<10) {
			      $id2="D000".$tambah2;
			    }else{
			      $id2="D00".$tambah2;
			    }
	    		$file=$_FILES['surat_rekom'];
	    		$nama_file=explode(".", $file['name']);
	    		$file_name="Surat Rekom-".$id.".".$nama_file[1];
	    		$file_temp=$file['tmp_name'];
	    		$name=explode('.',$file_name);
	    		$path="../dokumen/".$file_name;
	    		$conn->query("INSERT INTO `dokumen`(`id_dokumen`, `id_magang`, `name`, `file`) VALUES ('$id2', '$id', '$name[0]','$path')");
	    		move_uploaded_file($file_temp, $path);
	    	}
	    	$conn->query("UPDATE `magang` SET `proposal`='$id1',`surat_rekom`='$id2' WHERE id_magang='$id'");
	    	$nama=$_POST['nama'];
			$i=0;
			foreach($_FILES['kartu']['tmp_name'] as $key => $tmp_name) {
				$cari_max3=mysqli_query($conn, "SELECT MAX(id_pemagang) AS max FROM pemagang");
			    $cari3=mysqli_fetch_array($cari_max3);
			    $kode3=substr($cari3['max'],1,4);
			    $tambah3=$kode3+1;
			    if ($tambah3<10) {
			      $id3="P000".$tambah3;
			    }else{
			      $id3="P00".$tambah3;
			    }
				$namadb=$nama[$i];
				$i++;
				$nama_file=explode(".", $_FILES['kartu']['name'][$key]);
			    $file_name = "Kartu-".$id."-".$namadb.".".$nama_file[1];
			    $file_temp =$_FILES['kartu']['tmp_name'][$key];
			    $name=explode('.', $file_name);
			    $path="../dokumen/kartu/".$file_name;
			    $conn->query("INSERT INTO `pemagang`(`id_pemagang`, `id_magang`, `nama`, `kartu`, `file`) VALUES ('$id3', '$id', '$namadb', '$name[0]','$path')");
			    move_uploaded_file($file_temp, $path);
			}
			echo "<script> 
			        alert('Berhasil daftar!');
			        document.location.href = 'kegiatan.php';
			      </script>";
		}else{
		 	echo "<script> 
			        alert('Gagal daftar!');
			        document.location.href = 'daftar.php';
			      </script>";
		}	
    }
}
?>