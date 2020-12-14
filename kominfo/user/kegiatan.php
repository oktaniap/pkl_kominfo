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
      <nav class="navbar navbar-expand-lg  bg-dark">
        <div class="container">
        <a class="navbar-brand text-white" href="#">Hai, <strong><?php session_start(); echo $_SESSION['nama_depan']; ?></strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link mr-4" href="index.php">HOME</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4" href="daftar.php">DAFTAR MAGANG</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4" href="kegiatan.php">KEGIATAN</a>
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
      <div style="padding-top: 5%; font-size: 50px;">
        <center>
          <button class="btn" style="background-color: #A9A9A9; font-weight: bold;" onclick="window.location.href='kegiatan.php'">
            Status Magang
          </button>
          |
          <button class="btn" style="background-color: #A9A9A9; font-weight: bold; width: 13%;" onclick="window.location.href='bimbingan.php'">
            Bimbingan
          </button>
          |
          <button class="btn" style="background-color: #A9A9A9; font-weight: bold; width: 13%;" onclick="window.location.href='nilai.php'">
            Nilai
          </button>
        </center>
      </div>
      <?php
      $username=$_SESSION['username'];
      include "../koneksi.php";
      $sql = "SELECT * FROM magang WHERE username='$username'";
      $query = mysqli_query($conn, $sql);
      $cek=mysqli_num_rows($query);
      if ($cek==0) {
        ?><div class="container" style="border: 10px solid  #DCDCDC; margin-top: 5%; border-radius: 10px;padding-top: 3%;"><?php
        echo "Belum ada pengajuan";
        ?>
        </div>
        <?php
      }else{
        while ($row=mysqli_fetch_array($query)) {
          ?>
          <div class="container" style="border: 10px solid  #DCDCDC; margin-top: 5%; border-radius: 10px;padding-top: 3%;">
            <?php
            echo "PENGAJUAN MAGANG <br>";
            echo "NOMOR MAGANG ";
            $id_magang=$row['id_magang'];
            echo $id_magang;
            ?>
            <br>Tanggal Pengajuan
            <?php
            echo date('d F Y', strtotime($row['tgl_daftar']));
            ?>
            <br>Status
            <?php
            $status=$row['status'];
            $status=(int)$status;
            if ($status==1) {
              echo "Menunggu pengajuan dikonfirmasi";
            }if ($status==2) {
              echo "Magang diterima dan sedang berlangsung";
            }if ($status==3) {
              echo "Pengajuan ditolak";
            }if ($status==4) {
              echo "Penilaian dan pemberian sertifikat";
            }if ($status==5) {
              echo "Magang selesai, nilai dan sertifikat sudah keluar";
            }
            if ($status==2||$status==4||$status==5) {
              ?>
              <br>Tanggal Acc
              <?php echo date('d F Y', strtotime($row['tgl_acc'])); ?>
              <br>Bidang
              <?php
              echo $row['bidang'];
              $surat_balasan="Surat Balasan-".$id_magang;
              ?>
              <br>Surat Balasan
              <?php
              $sql2="SELECT * FROM `dokumen` WHERE name='$surat_balasan' AND id_magang='$id_magang'";
              $query2=mysqli_query($conn,$sql2);
              while ($row2=mysqli_fetch_array($query2)) {
                $name2=explode('../../dokumen/surat_balasan/', $row2['file']);
              }
              ?>
              <a href="download.php?file=<?php echo $name2[1]?>" class="btn btn-primary">Download</a>
              <?php
            }
            ?>
            <br>
            Daftar Pemagang
            <br>
            <?php
            $query1 ="SELECT * FROM pemagang WHERE id_magang='$id_magang'";
            $sql1 = mysqli_query($conn, $query1);
            $i=1;
            while ($row1=mysqli_fetch_array($sql1)) {
              echo $i.". ".$row1['nama'];
              $i++;
              ?><br><?php
            }
          }
          ?>
          </div>
          <?php
        }  
        ?>
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
