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
        <?php
        include "../../koneksi.php";
        $id_magang=$_GET['id_magang'];
        $sql= "SELECT * FROM `magang` WHERE id_magang='$id_magang'";
        $query = mysqli_query($conn, $sql);
        while ($row=mysqli_fetch_array($query)) {
          ?>
          <table><tr>
              <td>Institusi</td>
              <td><?php echo $row['institusi'];?></td>
              <tr>
                <td>Tanggal Mulai</td>
                <td><?php echo date('d F Y', strtotime($row['tgl_mulai']));?></td>
              </tr>
              <tr>
                <td>Tanggal Selesai</td>
                <td><?php echo date('d F Y', strtotime($row['tgl_selesai']));?></td>
              </tr>
              <tr>
                <td>Tujuan Magang</td>
                <td><?php echo $row['tujuan']."<br>";?></td>
              </tr>
          </table>
          Daftar Anggota <br>
          <?php
        }
        $sql1="SELECT * FROM pemagang WHERE id_magang='$id_magang'";
        $query1=mysqli_query($conn,$sql1);
        $no=1;
        while ($row1=mysqli_fetch_array($query1)) {
          echo $no++.". ".$row1['nama']."<br>";
        }
        echo "Riwayat Bimbingan";
        $sql2="SELECT * FROM bimbingan WHERE id_magang='$id_magang' AND status=2";
        $query2=mysqli_query($conn,$sql2);
        $cek2=mysqli_num_rows($query2);
        if ($cek2==0) {
          echo "<br>Belum ada";
        }else{
          $i=1;
          ?>
          <table>
            <tr>
              <td>No</td>
              <td>Tanggal</td>
              <td>Materi</td>
            </tr>
            <?php
            while ($row2=mysqli_fetch_array($query2)) {
              ?>
              <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo date('d F Y', strtotime($row2['tanggal'])); ?></td>
                <td><?php echo $row2['materi']; ?></td>
              </tr>
              <?php
            }
            ?>
          </table>
          <?php
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