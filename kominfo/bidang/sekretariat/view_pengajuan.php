<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <title>Pendaftaran Magang Kominfo</title>
  </head>
  <body>

  <!-- Navbar -->
      <nav class="navbar navbar-expand-lg  bg-dark" style="margin-top: 2%;">
        <div class="container">
        <a class="navbar-brand text-white" href="#" style="font-size: 27px;"><?php session_start(); echo $_SESSION['nama_belakang']; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link mr-4" href="index.php">HOME</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4" href="pengajuan.php">PENGAJUAN</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4" href="sertifikat.php">SERTIFIKAT</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4" href="bimbingan.php">BIMBINGAN</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4" href="magang.php">MAGANG</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4" href="logout.php">LOGOUT</a>
            </li>
          </ul>
        </div>
       </div> 
      </nav>
  <!-- Akhir Navbar -->

  <!-- Menu -->
      <div class="container" style="width: 60%;border: 10px solid #DCDCDC; margin-top: 2%; border-radius: 10px;font-size: 17px; padding-top: 2%; padding-left: 2%; padding-bottom: 1%;">
        <br>
        <br>
        <center><h4>PENGAJUAN MAGANG</h4></center>    
        <?php
        include "../../koneksi.php";
        $id_magang=$_GET['id_magang'];
        $sql= "SELECT * FROM `magang` WHERE id_magang='$id_magang'";
        $query = mysqli_query($conn, $sql);
        $cek = mysqli_num_rows($query);
        if ($cek==0) {
          echo "Tidak ada pengajuan";
        }else{
          while ($row=mysqli_fetch_array($query)) {
            ?>
            <table>
              <tr>
                <td>Nomor Magang</td>
                <td><?php echo $row['id_magang']; ?></td>
              </tr>
              <tr>
                <td>Tanggal Daftar</td>
                <td><?php echo date('d F Y', strtotime($row['tgl_daftar']));?></td>
              </tr>
              <tr>
                <td>Pemohon</td>
                <td>
                  <?php 
                  $username=$row['username'];
                  $sql1="SELECT `nama_depan`, `nama_belakang` FROM `pengguna` WHERE username='$username'"; 
                  $query1=mysqli_query($conn,$sql1); 
                  while ($row1=mysqli_fetch_array($query1)) {
                    echo $row1['nama_depan']." ".$row1['nama_belakang'];
                  } ?>  
                </td>
              </tr>
              <tr>
                <td>Institusi</td>
                <td><?php echo $row['institusi']; ?></td>
              </tr>
              <tr>
                <td>Jurusan</td>
                <td><?php echo $row['jurusan']; ?></td>
              </tr>
              <tr>
                <td>Tujuan Magang</td>
                <td><?php echo $row['tujuan'] ; ?></td>
              </tr>
              <tr>
                <td>Proposal</td>
                <td>
                  <?php
                  $proposal=$row['proposal'];
                  $sql2="SELECT * FROM `dokumen` WHERE id_dokumen='$proposal'";
                  $query2=mysqli_query($conn,$sql2);
                  while ($row2=mysqli_fetch_array($query2)) {
                    $name2 = explode('../dokumen/', $row2['file']);
                  }
                  ?>
                  <a href="download.php?file=<?php echo $name2[1]?>" class="btn btn-primary">Download</a>
                </td>
              </tr>
              <tr>
                <td>Surat Rekom</td>
                <td>
                  <?php
                  $surat=$row['surat_rekom'];
                  $sql3="SELECT * FROM `dokumen` WHERE id_dokumen='$surat'";
                  $query3=mysqli_query($conn,$sql3);
                  while ($row3=mysqli_fetch_array($query3)) {
                    $name3 = explode('../dokumen/', $row3['file']);
                  }
                  ?>
                  <a href="download.php?file=<?php echo $name3[1]?>" class="btn btn-primary">Download</a>
                </td>
              </tr>
              <tr>
                <td>Nama Anggota</td>
              </tr>
              <?php
              $sql4="SELECT * FROM `pemagang` WHERE id_magang='$id_magang'";
              $query4=mysqli_query($conn,$sql4);
              while ($row4=mysqli_fetch_array($query4)) {
                $i=1;
                ?>
                <tr>
                  <td><?php echo $i++;?></td>
                  <td><?php echo $row4['nama']; $name4 = explode('../dokumen/kartu/', $row4['file']); ?></td>
                  <td><a href="download1.php?file=<?php echo $name4[1]?>" class="btn btn-primary">Download</a></td>
                </tr>
                <?php
              }
              ?>
              <tr>
                <td></td>
                <td></td>
              </tr>
            </table>
            <button class="btn btn-primary" style="font-weight: bold; margin-left: 80%;" onclick="window.location.href='acc.php?id_magang=<?php echo $id_magang;?>'">ACC</button>
            <button class="btn btn-primary" style="font-weight: bold; margin-left: 80%;" onclick="konfirmasiDulu()">Reject</button>
            <script>
              function konfirmasiDulu(){
                var konfirmasi = confirm("Yakin untuk reject?");
                
                if(konfirmasi === true) {
                  document.location.href = 'reject.php?id_magang=<?php echo $id_magang;?>';
                }else{
                  
                }
              }
            </script>
            <?php
          }
        }
        ?>
      </div>
  <!-- Akhir Menu -->

  <!-- Awal Footer -->
      <hr class="footer">
      <div class="container">
        <div class="row footer-body">
          <div class="col-md-6">
          <div class="copyright">
            <strong>Copyright</strong> <i class="far fa-copyright"></i>2020 -  UPNVJT / KOMINFO</p>
          </div>
          </div>
        </div>
      </div>
  <!-- Akhir Footer -->


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.js"></script>
  </body>
</html>